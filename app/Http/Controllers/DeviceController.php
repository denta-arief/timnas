<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use App\Models\DeviceType;
use App\Models\Site;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $type = DeviceType::all();
        $device = Device::select('devices.id as id','device_name','device_jenis', 'device_ip', 'sites.site_name as device_site_kode', 'device_status')
        ->leftjoin('sites','sites.site_kode','=','device_site_kode')
        ->get();
        // dd($device);
        return view ('device.index',compact('type','device'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $type = DeviceType::all()->pluck('type_name','id');
        $site = Site::all()->pluck('site_name','site_kode');
        return view ('device.form_device',compact('type','site'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        foreach (DeviceType::where('id',$request->device_type)->get() as $value) {
            # code...
            $tipe_device = $value->type_name;
        } ;
        if ($request->swstatus == "on") {
            # code...
            $aktif = "AKTIF";
        } else {
            $aktif = "NONAKTIF";
        }
        $addDevice = [
            'device_name'=>$request->device_name,
            'device_jenis'=>$tipe_device,
            'device_ip' => $request->device_ip,
            'device_site_kode' => $request->site,
            'device_status' => $aktif];
        // dd($addDevice);
        Device::create($addDevice);
        return redirect('/devices');
    }

    /**
     * Display the specified resource.
     */
    public function show($id=null)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id=null)
    {
        //
        $type = DeviceType::all()->pluck('type_name','id');
        $site = Site::all()->pluck('site_name','site_kode');

        $device = Device::where('id',$id)->first();
        // dd($device);
        return view ('device.form_device',compact('device','type','site'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        foreach (DeviceType::where('id',$request->device_type)->get() as $value) {
            # code...
            $tipe_device = $value->type_name;
        } ;
        if ($request->swstatus == "on") {
            # code...
            $aktif = "AKTIF";
        } else {
            $aktif = "NONAKTIF";
        }
        $Device = [
            'device_name'=>$request->device_name,
            'device_jenis'=>$tipe_device,
            'device_ip' => $request->device_ip,
            'device_site_kode' => $request->site,
            'device_status' => $aktif];
        // dd($request);
        Device::where('id',$request->device_id)->update($Device);
        return redirect('/devices');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Device $device)
    {
        //
    }
}
