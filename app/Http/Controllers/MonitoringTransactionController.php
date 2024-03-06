<?php

namespace App\Http\Controllers;

use App\Models\MonitoringTransaction;
use App\Models\DeviceType;
use App\Models\Device;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MonitoringTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MonitoringTransaction $monitoringTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MonitoringTransaction $monitoringTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MonitoringTransaction $monitoringTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MonitoringTransaction $monitoringTransaction)
    {
        //
    }

    public function router()
    {
        //
        $device = Device::where('device_jenis','Router')->get();
        return view('monitoring.device', compact('$device'));
    }

    public function ping()
    {
        $host = Device::all()->pluck('device_ip','id');
        // $host = "192.168.14.251";
        $output = null;
        $resultCode = null;
        $currentTime = Carbon::now()->format('H:i:s');
        $currentDate = Carbon::now()->format('Y-m-d');

        // dd($host);
        foreach ($host as $key => $value) {
        //     # code...
            exec("ping -c 5 $value", $output[$key][], $resultCode);
         
            

            for ($i=1; $i < 6 ; $i++) { 
               
                if ($resultCode == 0 ) {
                    # code...
                    $data = [
                        'trans_tanggal'=> $currentDate,
                        'trans_waktu'=> $currentTime,
                        'trans_tipe'=>'PING',
                        'trans_device_id'=> $key,
                        'trans_result'=>$output[$key],
                        'trans_status'=>$resultCode,
                    ];
                } else {
                    $data = [
                        'trans_tanggal'=> $currentDate,
                        'trans_waktu'=> $currentTime,
                        'trans_tipe'=>'PING',
                        'trans_device_id'=> $key,
                        'trans_result'=>"",
                        'trans_status'=>$resultCode,
                    ];
                }
                dd($data);
                // MonitoringTransaction::create($data);
            };
        
        }
    }
}
