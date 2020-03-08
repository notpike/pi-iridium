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
        exec("ifconfig -a", $ifconfigVar);
        exec("uname -r", $versionVar);
        exec("df -h 2>&1", $filesystemVar);

        exec("free -m|awk '/^Mem:/{print $2}'", $totalMemVar); // mb
        exec("free -m|awk '/^Mem:/{print $3}'", $usedMemVar); // mb
        exec("free -m|awk '/^Swap:/{print $2}'", $totalSwapVar); // mb
        exec("free -m|awk '/^Swap:/{print $3}'", $usedSwapVar); // mb
        exec("dmesg 2>&1", $dmesgVar);

        return view('dashboard.rpi.index', [
            'cpuTemp'     => $cpuTempVar,
            'totalMemory' => $totalMemVar,
            'usedMemory'  => $usedMemVar,
            'totalSwap'   => $totalSwapVar,
            'usedSwap'    => $usedSwapVar,
            'filesystem'  => $filesystemVar, 
            'ifconfig'    => $ifconfigVar,
            'version'     => $versionVar,
            'dmesg'       => $dmesgVar
        ]);
    }

    /*
    *  SHUTDOWN
    */
    public function shutdown() {
        exec("shutdown now");
    }

    /*
    *  RESTART
    */
    public function restart() {
        exec("reboot --force");
    }
}
