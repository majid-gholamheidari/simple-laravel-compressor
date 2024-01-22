<?php

namespace App\Repositories;

use App\Interfaces\CompressorRepositoryInterface;
use App\Jobs\FileCompressorJob;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class CompressorRepository implements CompressorRepositoryInterface
{

    /**
     * Save uploaded file and start compressing the file.
     * @param $file
     * @return array
     */
    public function compressFile($file): array
    {
        $fileName = $file->getClientOriginalName();
        $basePath = "uploaded-files/" . Carbon::now()->timestamp . "/";
        $newFileName = $fileName . config('compressor.format');
        if (Storage::disk('local')->putFileAs($basePath, $file, $fileName)) {
            FileCompressorJob::dispatch($basePath . $fileName, $newFileName);
            return [
                'status' => true,
                'url' => url('/api/download-file?path=' . $basePath . $newFileName)
            ];
        }
        return ['status' => false];
    }
}
