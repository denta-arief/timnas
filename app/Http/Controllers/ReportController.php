<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Config;
use App\Models\Device;
use App\Models\MonitoringTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ReportController extends Controller
{
    //

    public function func_rpt_daily_status($device, $jam, $tanggal)
    {
        // $tmp = Carbon::createFromFormat('H:i', $jam);
        $rpt_date = Carbon::createFromFormat('Y-m-d H:i', $tanggal . " " . $jam);
        $rpt_date_2 = Carbon::createFromFormat('Y-m-d H:i', $tanggal . " " . $jam)->addHours(1);
       
        $tmp2 = MonitoringTransaction::whereBetween('trans_tanggal',[$rpt_date->toDateTimeString() ,$rpt_date_2->toDateTimeString()])
                ->where('trans_device_id', $device)->get();
        $result = 'UNKOWN';
        foreach ($tmp2 as $key => $value) {
            # code...
            $result = $value->trans_status;
        }
        // dd($tmp2);
        return $result;
    }
    
    public function rpt_daily(Request $request) {
        $hour = Config::select('rpt_daily_hours')->get();
        $jml = Config::select('rpt_daily_hours')->count();
        $device = Device::all();
        $arr_status[][]= null;
        // dd($request);
      
        if ($request->_token<>null) {
            # code...
            $request->validate([
                'frm_tanggal' => 'required|date',
            ]);
            // dd($request);
            // $valueTanggal = Carbon::createFromFormat('Y-m-d', $request->frm_tanggal);
            $valueTanggal = $request->frm_tanggal;
        } else {
            # code...
            // dd($request);
            $valueTanggal = Carbon::now()->format('Y-m-d');
            
        }
        // dd($valueTanggal);
        //Passing status device per device (Row)
        foreach ($device as $key => $valueDevice) {
            # code...
            foreach ($hour as $key => $valueHour) {
                # code...
                // dd($this->func_rpt_daily_status($valueDevice->id,$valueHour->rpt_daily_hours));
                
                $status = $this->func_rpt_daily_status($valueDevice->id, $valueHour->rpt_daily_hours, $valueTanggal);
                $arr_status[$valueDevice->id][$valueHour->rpt_daily_hours] = $status;
            }
        }
        $html = View::make('report.pdf_daily',compact('hour','jml','device','arr_status', 'valueTanggal'))->render();
        // dd($html);
        // Storage::put('/storage/dailyReport.html', $html);
        return view('report.daily',compact('hour','jml','device','arr_status', 'valueTanggal'));
    }

   
}
