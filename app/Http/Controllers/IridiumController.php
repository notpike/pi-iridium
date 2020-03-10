<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\IridiumJob;
use Artisan;

class IridiumController extends Controller
{
    public $job;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        return view('dashboard.iridium.index', [
            'data'     => 'data',
        ]);
    }


    // sudo iridium-extractor -D 4 software/gr-iridium/examples/rtl-sdr-T.conf | grep "A:OK" > Iridium/output/output3.bits
    public function startIridium(Request $request) {
        // $request->validate($request, [
        //     'd'      => 'required',
        //     'config' => 'required',
        //     'filename' => 'required'
        // ]);

        $store = $request->all();
        

        IridiumJob::dispatch($store);
        return redirect()->back();
    }

    // Killall hack FTW! >:D
    public function stopIridium() {
        $cmd = 'killall ping';
        $stdout = shell_exec($cmd);
        // dd($stdout);
        return redirect()->back();
    }
}
