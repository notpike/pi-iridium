<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class IridiumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        exec('cat /sys/class/thermal/thermal_zone0/temp 2>&1', $cpuTempVar);
        // exec("uname -r", $versionVar);
        $versionVar = File::get(public_path() . '/js/app.js');

        return view('dashboard.iridium.index', [
            'cpuTemp'     => $cpuTempVar,
            'version'     => $versionVar
        ]);
    }


    // sudo iridium-extractor -D 4 software/gr-iridium/examples/rtl-sdr-T.conf | grep "A:OK" > Iridium/output/output3.bits
    public function startIridium(Request $request) {
        $this->validate($request, [
            'd'         => 'required',
            'sdrConfig' => 'required',
            'fileName'  => 'required'
        ]);

        $store = $request->all();
        $cmd = 'iridium-extracto -D ' . $store['d'] . ' ' ;
    }

    public function readIridium() {
        
    }

    public function stopIridium() {
        
    }
}
