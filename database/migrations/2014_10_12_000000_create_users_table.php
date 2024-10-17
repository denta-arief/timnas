<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
<<<<<<< HEAD
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('chat_id');
            $table->rememberToken();
            $table->string('google_id');
            $table->string('telegram_username');
            $table->string('profile_picture');
            $table->timestamps();
=======
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('profile_picture')->nullable();
        $table->string('password');
        $table->string('telegram_username')->nullable();
        $table->timestamps();
>>>>>>> 59d3e6f2d953766e051eacb53911e5e1b6335155
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
