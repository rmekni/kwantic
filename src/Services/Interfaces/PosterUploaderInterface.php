<?php

namespace App\Services\Interfaces;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface PosterUploaderInterface
{
    /**
     * Upload given file in given directory
     *
     * @param UploadedFile $file
     * @param string $targetDir
     * @param string $type
     * @return string
     */
    public function upload(UploadedFile $file, string $targetDir, string $type = 'img'): string;

    /**
     * Move temporary file to specific directory
     *
     * @param UploadedFile $file
     * @return string
     */
    public function moveToTMPFolder(UploadedFile $file): string;
}
