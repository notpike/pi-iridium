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
    public $proc2;
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
     * PROC FUNCTION.
     *
     * @return bool
     */
    public function proc_cmd($cmd) {
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
        return true;  
    } 

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        // iridium-extractor -D 4 examples/hackrf.conf | grep "A:OK" > output.bits
        $cmd = 'iridium-extractor -D '
                . trim(escapeshellarg($this->init['d']), '\'') 
                . ' ' .  env('GR_IRIDIUM') . '/examples/' . trim($this->init['config'], '\'' )
                . ' grep "A:OK" > ' . base_path() . '/' . env('LOOT_CAPTURE') . '/' . trim(escapeshellarg($this->init['filename']),'\'');
        var_dump($cmd);

        // $cmd2 = 'ping 1.1.1.1 -c 5';
        $this->proc_cmd($cmd);

        // $cmd = "ping 1.1.1.1";
        // $cmd2 = 'grep ping';
        // broadcast(new IridiumBroadcast($cmd));

        // TRY 1
        // $this->proc  = popen($cmd . ' 2>&1', 'r');
        // // $this->proc2 = popen($cmd2, 'w');
        // while (!feof($this->proc)) {
        //     fwrite($this->proc, fread($this->proc, 4096));
        //     broadcast(new IridiumBroadcast(fread($this->proc2, 4096)));
        // }

        // pclose($cmd);
        // // pclose($cmd2);


        // TRY 0
        // $this->proc = shell_exec($cmd);
        // broadcast(new IridiumBroadcast($this->proc));


        // TRY 3
        // broadcast(new IridiumBroadcast($cmd));
        // ob_start();
        // passthru($cmd);
        // broadcast(new IridiumBroadcast($var));
        // ob_end_clean(); //Use this instead of ob_flush()


        // TRY 2
        // $descr = array(
        //     0=> array('pipe', 'r'),
        //     1=> array('pipe', 'w'),
        //     2=> array('pipe', 'w')
        // );

        // $pipes = array();
        // $proc = proc_open($cmd, $descr, $pipes);
        // if(is_resource($proc)) {
        //     while($f = fgets($pipes[1])) {
        //         broadcast(new IridiumBroadcast("pipe 1-->"));
        //         broadcast(new IridiumBroadcast($f));
        //     }
        //     fclose($pipes[1]);
        //     while ($f = fgets($pipes[2])) {
        //         broadcast(new IridiumBroadcast("pipe 2-->"));
        //         broadcast(new IridiumBroadcast(($f)));
        //     }
        //     fclose($pipes[2]);
        //     proc_close($proc);
        // } 
    }
}
