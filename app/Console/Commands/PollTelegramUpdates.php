<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PollTelegramUpdates extends Command
{
    protected $signature = 'telegram:poll-updates';
    protected $description = 'Poll updates from Telegram';
    protected static $lastMessageId = null;

    public function handle()
    {
        $pollDuration = 5 * 60; // 5 menit
        $startTime = microtime(true);

        $this->info('Polling Telegram updates...');

        // Looping selama durasi polling
        while ((microtime(true) - $startTime) < $pollDuration) {
            $this->pollUpdates();

            // Tunggu 3 detik sebelum polling lagi
            sleep(3);
        }

        $this->info('Polling finished after ' . $pollDuration . ' seconds.');
    }

    private function pollUpdates()
    {
        $botToken = config('services.telegram.bot_token');
        $offset = Cache::get('telegram_last_message_id') ? Cache::get('telegram_last_message_id') + 1 : null;
        $url = "https://api.telegram.org/bot$botToken/getUpdates" . ($offset ? "?offset=$offset" : "");
    
        $response = Http::get($url);
        $updates = $response->json();
    
        if (isset($updates['result'])) {
            foreach ($updates['result'] as $update) {
                $this->processUpdate($update);
    
                // Simpan offset terakhir di cache
                Cache::put('telegram_last_message_id', $update['update_id']);
            }
        }
    }    

    public function processUpdate($update)
    {
        // Pastikan ini adalah perintah /start
        if (isset($update['message']['text']) && $update['message']['text'] == '/start') {
            // Ambil username Telegram dari update
            $telegramUsername = $update['message']['from']['username'] ?? null;

            if ($telegramUsername) {
                // Kirim ke LoginController untuk handle login
                $this->handleMessage($update['message']['chat']['id'], $telegramUsername);
            } else {
                // Jika tidak ada username, kirim pesan error
                $this->sendMessage($update['message']['chat']['id'], 'Username Telegram tidak ditemukan.');
            }
        }
    }

    private function handleStartCommand($chatId, $username)
    {
        $currentTime = time();

        // Cek apakah user sudah menerima pesan dalam 5 detik terakhir
        if (Cache::has("last_message_time_$chatId") && (Cache::get("last_message_time_$chatId") > $currentTime - 5)) {
            return; // Jangan kirim pesan jika belum cukup lama (5 detik)
        }

        // Kirim pesan dengan link login ke halaman index
        $this->sendMessage($chatId, "Hai @$username, silakan klik link berikut untuk masuk ke halaman index: " . route('index'));

        // Simpan waktu pesan terakhir dikirim
        Cache::put("last_message_time_$chatId", $currentTime);
    }

        private function handleMessage($chatId, $username)
    {
        $currentTime = time();

        // Cek apakah user sudah menerima pesan dalam 5 detik terakhir
        if (Cache::has("last_message_time_$chatId") && (Cache::get("last_message_time_$chatId") > $currentTime - 5)) {
            return; // Jangan kirim pesan jika belum cukup lama (5 detik)
        }

        // Cari user di database menggunakan username Telegram
        $user = User::where('telegram_username', $username)->first();

        if ($user) {
            // Kirim pesan dengan link login ke halaman callback Telegram menggunakan telegram_username
            $loginLink = route('telegram.callback', ['telegramUsername' => $username]);
            $this->sendMessage($chatId, "Hai @$username! Klik [disini]($loginLink) untuk login.");
        } else {
            // Jika user tidak ditemukan, kirim pesan error
            $this->sendMessage($chatId, "Username anda tidak terdaftar.");
        }

    // Simpan waktu pesan terakhir dikirim
    Cache::put("last_message_time_$chatId", $currentTime);
}
  
    public function sendMessage($chatId, $message)
    {
        $url = "https://api.telegram.org/bot" . config('services.telegram.bot_token') . "/sendMessage";
        $params = [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'Markdown'
        ];

        file_get_contents($url . '?' . http_build_query($params));
    }
}
