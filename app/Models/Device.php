<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $fillable = [
        'device_name',
        'device_jenis',
        'device_ip',
        'device_site_kode',
        'device_status',
    ];
}
