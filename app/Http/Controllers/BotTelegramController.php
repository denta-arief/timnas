<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Api;
use Telegram\Bot\FileUpload\InputFile;

class BotTelegramController extends Controller
{
    //
    public function setWebHook(){
        $response = Telegram::setWebhook(['url' => env('TELEGRAM_WEBHOOK_URL')]);
        dd($response);
    }

    public function commandHandlerWebHook(Request $request){
        $update = Telegram::getWebhookUpdate();
        $message = $update->getMessage();

        // Tambahkan logika bot di sini

        // if(strtolower($update->getMessage()->getText()) == 'halo')
        // return Telegram::sendMessage([
        //     'chat_id' => $chat_id,
        //     'text' => 'HALO NJIR CHAT AMA BOT, KATEK GAWE KAU ' . $username,
        // ])
        // ;
        // $response = Telegram::setWebhook(['url' => env('TELEGRAM_WEBHOOK_URL')]);

        foreach ($message['chat'] as $key => $value) {
            # code...
            if ($key == 'first_name') {
                # code...
                $nama = $value;
            }
        }
        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
        // $update = Telegram::commandsHandler(true);
        return $telegram->sendMessage([
            'chat_id' => '6852425480',
            'text' => 'Oke '. $nama . ', fyi harap maklum saya cuma menyampaikan laporan. Gak usah sok asik ngajak ngobrol lah ya...' ,
        ]);
    }
    public function sendPdf(){
        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
        $tanggal = Carbon::now()->format('d-m-Y');
        // Path file PDF
        $pdfPath = storage_path('app/public/example.pdf');
        $document = InputFile::create($pdfPath, 'Daily Report '. $tanggal . '.pdf');
        // Kirim file PDF ke bot Telegram
        $response = $telegram->sendDocument([
            'chat_id' => '6852425480', // Ganti dengan ID obrolan target
            'document' => $document,
            'caption' => 'Laporan Network Site PTPN 1 Reg 7 periode ' . $tanggal,
        ]);
        return  $response->getMessageId();
    }
}
