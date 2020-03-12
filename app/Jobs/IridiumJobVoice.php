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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // sudo iridium-extractor -D 4 software/gr-iridium/examples/rtl-sdr-T.conf | grep "A:OK" > Iridium/output/output3.bits
        // $cmd = 'iridium-extractor -D' 
        //         . escapeshellarg($this->init['d']) 
        //         . ' ' . $this->init['config'] 
        //         . ' ' . '| grep "A:OK" > ' . escapeshellarg($this->init['filename']);

        $cmd = 'ping 8.8.8.8';
        $this->proc = popen($cmd, 'r');
        while (!feof($this->proc)) {
            broadcast(new IridiumBroadcastVoice(fread($this->proc, 4096)));
        }
    }
}
