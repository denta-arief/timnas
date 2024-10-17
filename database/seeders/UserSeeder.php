<?php

namespace Database\Seeders;

<<<<<<< HEAD
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
=======
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Denta Arief',
            'email' => 'denta.arief@gmail.com',
            'email_verified_at' => '',
            'telegram_username' => '@d_a_r_i_e_f',
            'password' => Hash::make('password123'),
            'email_verified_at' => null,
        ]);
    }
}
>>>>>>> 59d3e6f2d953766e051eacb53911e5e1b6335155
