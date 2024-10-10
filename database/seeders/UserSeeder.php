<?php

namespace Database\Seeders;

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
