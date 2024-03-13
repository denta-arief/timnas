<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeviceType;
use Illuminate\Support\Facades\DB;
use Database\Factories\DeviceTypeFactory;
use App\Models\Site;
use App\Models\Config;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('device_types')->delete();
        DB::table('sites')->delete();
        DB::table('configs')->delete();
        $types = [
            ['id' => 1, 'type_name' => 'Router'],
            ['id' => 2, 'type_name' => 'Access Point',],
            ['id' => 3, 'type_name' => 'Firewall',],
            ['id' => 4, 'type_name' => 'Computer',],
        ];
        $sites = [
            ['id' => 1, 'site_kode' => 'KDIR', 'site_name'=>'Kantor Regional 7', 'site_wilayah' =>'Lampung', 'site_aktif'=>1],
            ['id' => 2, 'site_kode' => 'KSSL', 'site_name'=>'Kantor Perwakilan Sumsel', 'site_wilayah' =>'Lampung', 'site_aktif'=>1],
            ['id' => 3, 'site_kode' => 'KBKL', 'site_name'=>'Kantor Perwakilan Bengkulu', 'site_wilayah' =>'Lampung', 'site_aktif'=>1],
            ['id' => 4, 'site_kode' => 'KEDA', 'site_name'=>'Kedaton', 'site_wilayah' =>'Lampung', 'site_aktif'=>1],
            ['id' => 5, 'site_kode' => 'TRIKORA', 'site_name'=>'Trikora', 'site_wilayah' =>'Lampung', 'site_aktif'=>1],
            ['id' => 6, 'site_kode' => 'RESA', 'site_name'=>'Rejosari', 'site_wilayah' =>'Lampung', 'site_aktif'=>1],
            ['id' => 7, 'site_kode' => 'PEWA', 'site_name'=>'Pematang Kiwah', 'site_wilayah' =>'Lampung', 'site_aktif'=>1],
            ['id' => 8, 'site_kode' => 'BEGE', 'site_name'=>'Bergen', 'site_wilayah' =>'Lampung', 'site_aktif'=>1],
            ['id' => 9, 'site_kode' => 'WABE', 'site_name'=>'Way Berulu', 'site_wilayah' =>'Lampung', 'site_aktif'=>1],
            ['id' => 10, 'site_kode' => 'WALI', 'site_name'=>'Way Lima', 'site_wilayah' =>'Lampung', 'site_aktif'=>1],
            ['id' => 11, 'site_kode' => 'BEKI', 'site_name'=>'Bekri', 'site_wilayah' =>'Lampung', 'site_aktif'=>1],
            ['id' => 12, 'site_kode' => 'PATU', 'site_name'=>'Padang Ratu', 'site_wilayah' =>'Lampung', 'site_aktif'=>1],
            ['id' => 13, 'site_kode' => 'TUBU', 'site_name'=>'Tulung Buyut', 'site_wilayah' =>'Lampung', 'site_aktif'=>1],
            ['id' => 14, 'site_kode' => 'MULA', 'site_name'=>'Musilandas', 'site_wilayah' =>'Palembang', 'site_aktif'=>1],
            ['id' => 15, 'site_kode' => 'TEBE', 'site_name'=>'Tebenan', 'site_wilayah' =>'Palembang', 'site_aktif'=>1],
            ['id' => 16, 'site_kode' => 'BETU', 'site_name'=>'Betung', 'site_wilayah' =>'Palembang', 'site_aktif'=>1],
            ['id' => 17, 'site_kode' => 'BEKA', 'site_name'=>'Betung Krawo', 'site_wilayah' =>'Palembang', 'site_aktif'=>1],
            ['id' => 18, 'site_kode' => 'TASA', 'site_name'=>'Talang Sawit', 'site_wilayah' =>'Palembang', 'site_aktif'=>1],
            ['id' => 19, 'site_kode' => 'BETA', 'site_name'=>'Bentayan', 'site_wilayah' =>'Palembang', 'site_aktif'=>1],
            ['id' => 20, 'site_kode' => 'BERI', 'site_name'=>'Beringin', 'site_wilayah' =>'Palembang', 'site_aktif'=>1],
            ['id' => 21, 'site_kode' => 'SENULING', 'site_name'=>'Senuling', 'site_wilayah' =>'Palembang', 'site_aktif'=>1],
            ['id' => 22, 'site_kode' => 'BAJA', 'site_name'=>'Baturaja', 'site_wilayah' =>'Palembang', 'site_aktif'=>1],
            ['id' => 23, 'site_kode' => 'SULI', 'site_name'=>'Sungai Lengi', 'site_wilayah' =>'Palembang', 'site_aktif'=>1],
            ['id' => 24, 'site_kode' => 'SUNI', 'site_name'=>'Sungai Niru', 'site_wilayah' =>'Palembang', 'site_aktif'=>1],
            ['id' => 25, 'site_kode' => 'SENA', 'site_name'=>'Senabing', 'site_wilayah' =>'Palembang', 'site_aktif'=>1],
            ['id' => 26, 'site_kode' => 'BERAU', 'site_name'=>'Sungai Berau', 'site_wilayah' =>'Palembang', 'site_aktif'=>1],
            ['id' => 27, 'site_kode' => 'PALA', 'site_name'=>'Pagar Alam', 'site_wilayah' =>'Palembang', 'site_aktif'=>1],
            ['id' => 28, 'site_kode' => 'TAPI', 'site_name'=>'Talopino', 'site_wilayah' =>'Bengkulu', 'site_aktif'=>1],
            ['id' => 29, 'site_kode' => 'PAWI', 'site_name'=>'Padang Pelawi', 'site_wilayah' =>'Bengkulu', 'site_aktif'=>1],
            ['id' => 30, 'site_kode' => 'KETA', 'site_name'=>'Ketahun', 'site_wilayah' =>'Bengkulu', 'site_aktif'=>1],
            ['id' => 31, 'site_kode' => 'PANJANG', 'site_name'=>'IPMG Panjang', 'site_wilayah' =>'Lampung', 'site_aktif'=>1],
            ['id' => 32, 'site_kode' => 'BAAI', 'site_name'=>'IPMG Pulo Baai', 'site_wilayah' =>'Bengkulu', 'site_aktif'=>1],
            ['id' => 33, 'site_kode' => 'BOOM', 'site_name'=>'IPMG Boom Baru', 'site_wilayah' =>'Palembang', 'site_aktif'=>1],
            ['id' => 34, 'site_kode' => 'BUMA', 'site_name'=>'Bunga Mayang', 'site_wilayah' =>'Lampung', 'site_aktif'=>1],
            ['id' => 35, 'site_kode' => 'CIMA', 'site_name'=>'Cinta Manis', 'site_wilayah' =>'Bengkulu', 'site_aktif'=>1],
            ['id' => 36, 'site_kode' => 'KPLO', 'site_name'=>'Kantor LO', 'site_wilayah' =>'Jakarta', 'site_aktif'=>1],
            
        ];
        $configs = [
            ['id' => 1, 'rpt_daily_hours' => '07:00'],
            ['id' => 2, 'rpt_daily_hours' => '08:00'],
            ['id' => 3, 'rpt_daily_hours' => '09:00'],
            ['id' => 4, 'rpt_daily_hours' => '10:00'],
            ['id' => 5, 'rpt_daily_hours' => '11:00'],
            ['id' => 6, 'rpt_daily_hours' => '12:00'],
            ['id' => 7, 'rpt_daily_hours' => '13:00'],
            ['id' => 8, 'rpt_daily_hours' => '14:00'],
            ['id' => 9, 'rpt_daily_hours' => '15:00'],
            ['id' => 10, 'rpt_daily_hours' => '16:00'],
            ['id' => 11, 'rpt_daily_hours' => '17:00'],
        ];
        foreach($types as $tipe){
            DeviceType::create($tipe);
        }
        foreach($sites as $site){
            Site::create($site);
        }
        foreach($configs as $config){
            Config::create($config);
        }
    }
}
