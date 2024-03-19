<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Device;

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
    public function device() {
        return $this->belongsTo('App\Models\Device');
    }
}
