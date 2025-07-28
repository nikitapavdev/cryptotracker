<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class SendToFileGuard implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    protected $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Http::post('http://fileguard:8080/secure', [
            'path' => $this->path,
        ]);
    }
}
