<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Buat akun manual
        User::create([
            'name' => 'Rafli Aldy',
            'email' => 'raflialdy401@gmail.com',
            'password' => bcrypt('rafli250723'),
            'chat_id' => null,
        ]);

        // Buat akun Google dengan data Telegram
        User::create([
            'name' => 'isni abrianti', 
            'email' => 'isniabrianti@gmail.com',
            'google_id' => '110924110571148712296', 
            'password' => bcrypt('24desember06'), 
            'chat_id' => null, // chat_id dari data Telegram
            'telegram_username' => 'isniabrianti', // Telegram username
        ]);
    }
}