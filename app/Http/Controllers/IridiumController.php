<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IridiumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        exec('cat /sys/class/thermal/thermal_zone0/temp 2>&1', $cpuTempVar);
        exec("uname -r", $versionVar);

        return view('dashboard.iridium.index', [
            'cpuTemp'     => $cpuTempVar,
            'version'     => $versionVar
        ]);
    }

    public function startIridium() {
        
    }

    public function stopIridium() {
        
    }
}
