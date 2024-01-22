<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class FileCompressorJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $filePath;
    private $fileName;

    /**
     * Create a new job instance.
     */
    public function __construct(string $filePath, string $fileName)
    {
        $this->filePath = $filePath;
        $this->fileName = $fileName;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $file = Storage::get($this->filePath);
        Storage::disk('local')->put($this->filePath, $file);
        Storage::disk('local')->copy($this->filePath, $this->filePath . config('compressor.format'));

    }

}
