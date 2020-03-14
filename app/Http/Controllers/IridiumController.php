<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\IridiumJob;
use App\Jobs\IridiumJobDecode;
use App\Jobs\IridiumJobVoice;

use Carbon\Carbon;

class IridiumController extends Controller
{


    public function index() {
        // SDR Config builder
        $cdir = scandir(env('GR_IRIDIUM'). '/examples');
        // Removes "." and ".."
        foreach ($cdir as $key => $value) {
            if(!in_array($value,array(".",".."))) {
                $config[] = $value;
            }
        }

        $cdir = scandir(base_path() . '/' . env('LOOT_CAPTURE'));
        // Removes "." and ".."
        foreach ($cdir as $key => $value) {
            if(!in_array($value,array(".",".."))) {
                $capture[] = $value;
            }
        }

        return view('dashboard.iridium.index', [
            'data_config'  => $config,
            'data_capture' => $capture,
            'time' => Carbon::now()->timestamp
        ]);
    }


    public function startIridium(Request $request) {
        // Kill any running processes
        // $this->stopIridium();

        // SDR Config builder
        $cdir = scandir(env('GR_IRIDIUM'). '/examples');
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
        // Clear Jobs

        if(env('APP_DEBUG')) {
            $cmd = 'killall ping';
            $stdout = shell_exec($cmd);
        } else {
            $cnd = 'killall iridium-extractor';
            $stdout = shell_exec($cmd);
        }
        return redirect()->back();
    }


    public function startDecode(Request $request) {

        // catureFile select
        $cdir = scandir(base_path() . '/' . env('LOOT_CAPTURE'));
        foreach ($cdir as $key => $value) {         // Removes "." and ".."
            if(!in_array($value,array(".",".."))) {
                $config[] = $value;
            }
        }

        $this->validate($request, [
            'mode'      => 'required',
            'captureFile' =>  'required | in:' . implode(',', $config),
            'filename' => 'required'
        ]);

        $store = $request->all();
        IridiumJobDecode::dispatch($store);

        return redirect()->back();
    }

    
    // KillAll hack FTW! >:D
    public function stopDecode() {
        if(env('APP_DEBUG')) {
            $cmd = 'killall ping';
            $stdout = shell_exec($cmd);
        } else {
            // Logic?
        }

        return redirect()->back();
    }

    public function startVoice(Request $request) {

        // Capture File Select
        $cdir = scandir(base_path() . '/' . env('LOOT_CAPTURE'));
        foreach ($cdir as $key => $value) {         // Removes "." and ".."
            if(!in_array($value,array(".",".."))) {
                $config[] = $value;
            }
        }

        $this->validate($request, [
            'captureFile' =>  'required | in:' . implode(',', $config),
            'filename' => 'required'
        ]);

        $store = $request->all();
        IridiumJobVoice::dispatch($store);

        return redirect()->back();
    }

    // KillAll hack FTW! >:D
    public function stopVoice() {
        if(env('APP_DEBUG')) {
            $cmd = 'killall ping';
            $stdout = shell_exec($cmd);
        } else {
            // Logic?
        }
        return redirect()->back();
    }    

}
