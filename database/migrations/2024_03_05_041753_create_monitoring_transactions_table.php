<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('monitoring_transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('trans_tanggal');
            $table->time('trans_waktu');
            $table->string('trans_tipe');
            $table->unsignedBigInteger('trans_device_id');
            $table->string('trans_result');
            $table->string('trans_status');
            $table->timestamps();

            $table->foreign('trans_device_id')->references('id')->on('devices');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_transactions');
    }
};
