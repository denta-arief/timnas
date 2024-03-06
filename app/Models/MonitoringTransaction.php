<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'trans_tanggal',
        'trans_waktu',
        'trans_tipe',
        'trans_device_id',
        'trans_result',
        'trans_status',
    ];
}
