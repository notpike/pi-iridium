<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\IridiumJob;
use Carbon\Carbon;

class IridiumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // SDR Config builder
        $cdir = scandir(env('GR_IRIDIUM'));
        // Removes "." and ".."
        foreach ($cdir as $key => $value) {
            if(!in_array($value,array(".",".."))) {
                $config[] = $value;
            }
        }

        return view('dashboard.iridium.index', [
            'data' => $config,
            'time' => Carbon::now()->timestamp
        ]);
    }

    public function startIridium(Request $request) {
        // Kill any running processes
        $this->stopIridium();

        // SDR Config builder
        $cdir = scandir(env('GR_IRIDIUM'));
        foreach ($cdir as $key => $value) {         // Removes "." and ".."
            if(!in_array($value,array(".",".."))) {
                $config[] = $value;
            }
        }

        $this->validate($request, [
            'd'      => 'required | integer | between:1,10',
            'config' =>  'required | in:' . implode(',', $config),
            'filename' => 'required'
        ]);

        $store = $request->all();
        IridiumJob::dispatch($store);

        return redirect()->back();
    }

    // KillAll hack FTW! >:D
    public function stopIridium() {
        $cmd = 'killall ping';
        $stdout = shell_exec($cmd);
        return redirect()->back();
    }
}
