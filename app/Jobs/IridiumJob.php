<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Events\IridiumBroadcast;

class IridiumJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $proc;
    public $init;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct($init)
    {
        $this->init = $init;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        // if(env('APP_DEBUG')) {
        //     $cmd = 'ping 1.1.1.1';
        //     $this->proc = popen($cmd, 'r');

        //     while (!feof($this->proc)) {
        //         broadcast(new IridiumBroadcast(fread($this->proc, 4096)));
        //     }
        // } else {
            // sudo iridium-extractor -D 4 software/gr-iridium/examlsples/rtl-sdr-T.conf | grep "A:OK" > Iridium/output/output3.bits
            $cmd = 'iridium-extractor -D '
                    . trim(escapeshellarg($this->init['d']), '\'') 
                    . ' ' .  env('GR_IRIDIUM') . '/examples/' . trim($this->init['config'], '\'' );
            //         . ' ' . '| grep "A:OK" > ' . base_path() . '/' . env('LOOT_CAPTURE') . '/' . trim(escapeshellarg($this->init['filename']),'\'');
           
            // $this->proc = popen($cmd, 'r');
            // while (!feof($this->proc)) {
            //     broadcast(new IridiumBroadcast(fread($this->proc, 4096)));
            // }

            // $this->proc = shell_exec($cmd);
            // broadcast(new IridiumBroadcast($this->proc));
        // }

        // $cmd = "ping 1.1.1.1";


        broadcast(new IridiumBroadcast($cmd));

        $descr = array(
            0=> array('pipe', 'r'),
            1=> array('pipe', 'w'),
            2=> array('pipe', 'w')
        );

        $pipes = array();
        $proc = proc_open($cmd, $descr, $pipes);
        if(is_resource($proc)) {
            while($f = fgets($pipes[1])) {
                broadcast(new IridiumBroadcast("pipe 1-->"));
                broadcast(new IridiumBroadcast($f));
            }
            fclose($pipes[1]);
            while ($f = fgets($pipes[2])) {
                broadcast(new IridiumBroadcast("pipe 2-->"));
                broadcast(new IridiumBroadcast(($f)));
            }
            fclose($pipes[2]);
            proc_close($proc);
        }
        

        
    }
}
