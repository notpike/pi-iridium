<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Events\Iridium;
use Illuminate\Http\Request;

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
    // public function __construct(Request $request)
    // {
    //     $this->request = $request;
    // }
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
        $cmd = 'ping 1.1.1.1';
        $this->proc = popen($cmd, 'r');
        while (!feof($this->proc)) {
            broadcast(new Iridium(fread($this->proc, 4096)));
        }
    }
}
