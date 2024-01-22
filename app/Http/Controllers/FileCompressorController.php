<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Interfaces\CompressorRepositoryInterface;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FileCompressorController extends Controller
{

    private CompressorRepositoryInterface $compressorInterface;
    public function __construct(CompressorRepositoryInterface $compressorInterface)
    {
        $this->compressorInterface = $compressorInterface;
    }

    /**
     *
     * @param UploadFileRequest $request
     * @return mixed
     */
    public function fileCompressor(UploadFileRequest $request)
    {
        $file = $request->file('file');
        $compressor = $this->compressorInterface->compressFile($file);
        if ($compressor['status'])
            return Response::success(['compressed_link' => $compressor['url']], 'Your file put in compress queue.');
        return Response::error();
    }

    /**
     * @return BinaryFileResponse
     */
    public function downloadFile()
    {
        $filePath = request('path');
        if (Storage::disk('local')->exists($filePath)) {
            return Response::download(storage_path('/app/' . $filePath));
        }

        return Response::error('The file does not exist or is being compressed.', 400);
    }
}
