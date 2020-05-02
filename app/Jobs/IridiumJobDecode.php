<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Events\IridiumBroadcastDecode;

class IridiumJobDecode implements ShouldQueue
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
     * PROC FUNCTION.
     *
     * @return bool
     */
    public function proc_cmd($cmd) {
        broadcast(new IridiumBroadcastDecode($cmd));

        $descr = array(
            0=> array('pipe', 'r'),
            1=> array('pipe', 'w'),
            2=> array('pipe', 'w')
        );

        $pipes = array();
        $proc = proc_open($cmd, $descr, $pipes);
        if(is_resource($proc)) {
            while($f = fgets($pipes[1])) {
                broadcast(new IridiumBroadcastDecode("pipe 1-->"));
                broadcast(new IridiumBroadcastDecode($f));
            }
            fclose($pipes[1]);
            while ($f = fgets($pipes[2])) {
                broadcast(new IridiumBroadcastDecode("pipe 2-->"));
                broadcast(new IridiumBroadcastDecode(($f)));
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

        // Parse
        // pypy iridium-parser.py -p output.bits
        $cmd = 'pypy ' . env('GR_IRIDIUM_TOOLS') . '/iridium-parser.py '
                . base_path() . '/' . env('LOOT_CAPTURE') . '/' . trim(escapeshellarg($this->init['captureFile']), "\'") 
                . ' > ' . base_path() . '/' . env('LOOT_PARSED') . '/decode.parsed';

        // Decode
        // pypy reassembler.py -i output.parsed -m <mode>
        $cmd2 = 'pypy ' . env('GR_IRIDIUM_TOOLS') . '/reassembler.py -i '
                 . base_path() . '/' . env('LOOT_PARSED') . '/decode.parsed'
                 . ' -m ' . trim(escapeshellarg($this->init['mode']), "\'")
                 . ' > ' . base_path() . '/' . env('LOOT_DECODE') . '/' . trim(escapeshellarg($this->init['filename']), "\'");

        // Show content        
        $cmd3 = 'cat ' . base_path() . '/' . env('LOOT_DECODE') . '/' . trim(escapeshellarg($this->init['filename']), "\'");
        var_dump($cmd);

        $this->proc_cmd($cmd);
        $this->proc_cmd($cmd2);
        $this->proc_cmd($cmd3);


        
    }
}
