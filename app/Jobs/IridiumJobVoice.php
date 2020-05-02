<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Events\IridiumBroadcastVoice;

class IridiumJobVoice implements ShouldQueue
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
        broadcast(new IridiumBroadcastVoice($cmd));

        $descr = array(
            0=> array('pipe', 'r'),
            1=> array('pipe', 'w'),
            2=> array('pipe', 'w')
        );

        $pipes = array();
        $proc = proc_open($cmd, $descr, $pipes);
        if(is_resource($proc)) {
            while($f = fgets($pipes[1])) {
                broadcast(new IridiumBroadcastVoice("pipe 1-->"));
                broadcast(new IridiumBroadcastVoice($f));
            }
            fclose($pipes[1]);
            while ($f = fgets($pipes[2])) {
                broadcast(new IridiumBroadcastVoice("pipe 2-->"));
                broadcast(new IridiumBroadcastVoice(($f)));
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
                . ' > ' . base_path() . '/' . env('LOOT_PARSED') . '/voc.parsed';

        // Grep VOC
        // grep "VOC" /home/notpike/Iridium/parsed/output2.parsed > /home/notpike/Iridium/voc/voc2.bits
        $cmd2 = 'grep "VOC" '
                 . base_path() . '/' . env('LOOT_PARSED') . '/vox.parsed'
                 . ' > ' . base_path() . '/' . env('LOOT_PARSED') . '/voc_filtered.parsed';

        // Convert the VOC binary payloads to dfs.
        // bits_to_dfs.py /home/notpike/Iridium/voc/voc2.bits /home/notpike/Iridium/dfs/voc2.dfs
        $cmd3 = 'pypy ' . env('GR_IRIDIUM_TOOLS') . '/bits_to_dfs.py '
                 . base_path() . '/' . env('LOOT_PARSED') . '/voc_filtered.parsed '
                 . base_path() . '/' . env('LOOT_PARSED') . '/voc.dfs';

        // Convert to Wave 
        // iridium-toolkit/ambe_emu/ambe -w /home/notpike/Iridium/dfs/voc2.dfs 
        $cmd4 = env('GR_IRIDIUM_TOOLS') . '/ambe_emu/ambe -w '
                     . base_path() . '/' . env('LOOT_PARSED') . '/voc.dfs';
                     //. base_path() . '/' . env('LOOT_VOICE') . '/' . trim(escapeshellarg($this->init['filename']), "\'");

        var_dump($cmd);
        var_dump($cmd2);
        var_dump($cmd3);
        var_dump($cmd4);

        $this->proc_cmd($cmd);
        $this->proc_cmd($cmd2);
        $this->proc_cmd($cmd3);
        $this->proc_cmd($cmd4);

    }
}
