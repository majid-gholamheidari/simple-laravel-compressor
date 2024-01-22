<?php

namespace App\Interfaces;


interface CompressorRepositoryInterface
{
    /**
     * @param $file
     */
    public function compressFile($file);
}
