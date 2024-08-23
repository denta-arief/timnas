<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimbanganController extends Controller
{
    //
    public static function insertTicket() {

        DB::connection('stagging')->table('wbticket')
                    ->where('NOTICKET','like','PALM7F%')
                    ->delete();

        try {
            //code...
            $ordersBeki = DB::connection('beki1')->table('wbticket')
            ->whereNull('TGLKELUAR')
            ->where('JENISMUATAN','NOT LIKE', '1%')
            ->get();
            foreach ($ordersBeki as $key) {
                # code...
                $key = (array)$key;
                unset($key['RUB_FAC_KRG'], $key['RUB_SMP_BSH'], $key['RUB_SMP_KRG'],$key['STD_PRICE'] );
                $beki[] = $key;
                
            }
            DB::connection('stagging')->table('wbticket')->insert($beki);
        } catch (\Throwable $th) {
            //throw $th;
            $ordersBeki = collect();
        }
       
        try {
            //code...
            $ordersBetu = DB::connection('betu1')->table('wbticket')
                    ->whereNull('TGLKELUAR')
                    ->where('JENISMUATAN','NOT LIKE', '1%')
                    ->get();
            foreach ($ordersBetu as $key) {
                # code...
                $key = (array)$key;
                unset($key['RUB_FAC_KRG'], $key['RUB_SMP_BSH'], $key['RUB_SMP_KRG'],$key['STD_PRICE'] );
                $betu[] = $key;
                
            }
            DB::connection('stagging')->table('wbticket')->insert($betu);    
        } catch (\Throwable $th) {
            //throw $th;
            $ordersBetu = collect();
        }
            
        try {
            //code...
            $ordersTasa = DB::connection('tasa1')->table('wbticket')
                    ->whereNull('TGLKELUAR')
                    ->where('JENISMUATAN','NOT LIKE', '1%')
                    ->get();
            foreach ($ordersTasa as $key) {
                # code...
                $key = (array)$key;
                unset($key['RUB_FAC_KRG'], $key['RUB_SMP_BSH'], $key['RUB_SMP_KRG'],$key['STD_PRICE'] );
                $tasa[] = $key;
                
            }
            DB::connection('stagging')->table('wbticket')->insert($tasa);  
        } catch (\Throwable $th) {
            //throw $th;
            $ordersTasa = collect();
        }

              
        try {
            //code...
            $ordersSuli = DB::connection('suli1')->table('wbticket')
            ->whereNull('TGLKELUAR')
            ->where('JENISMUATAN','NOT LIKE', '1%')
            ->get();
            foreach ($ordersSuli as $key) {
                # code...
                $key = (array)$key;
                unset($key['RUB_FAC_KRG'], $key['RUB_SMP_BSH'], $key['RUB_SMP_KRG'],$key['STD_PRICE'] );
                $suli[] = $key;
                
            }
            DB::connection('stagging')->table('wbticket')->insert($suli);        
        } catch (\Throwable $th) {
            //throw $th;
            $ordersSuli = collect();
        }
       
        
      
        // foreach ($ordersBeki as $order) {
        //     dd($order->NOTICKET);
        // }
        // foreach ($ordersBetu as $order) {
        //     dd($order->NOTICKET);
        // }
    }
}