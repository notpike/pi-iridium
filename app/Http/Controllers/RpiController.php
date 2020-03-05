<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RpiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        exec('cat /sys/class/thermal/thermal_zone0/temp 2>&1', $cpuTempVar);
        exec("df -h 2>&1", $memVar);
        exec("df -h 2>&1", $filesystemVar);


        return view('dashboard.rpi.index', [
            'cpuTemp'    => $cpuTempVar,
            'memory'     => $memVar,
            'filesystem' => $filesystemVar 
        ]);
    }
}
