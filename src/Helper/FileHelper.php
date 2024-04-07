<?php

namespace App\Helper;

use App\Services\PosterUploader;
use Symfony\Component\HttpFoundation\File\File;

class FileHelper
{
    public function __construct(
        private ContainerHelper $containerHelper,
        private PosterUploader $posterUploader
    ) {
    }

    /**
     * Upload file to temp destination
     *
     * @param array | FileType $files
     * @param string $targetDir
     * @return string
     */
    public function uploadTEMPFile($files)
    {
        if (is_array($files)) {
            foreach ($files as $file) {
                return $this->posterUploader->moveToTMPFolder($file);
            }
        } else {
            return $this->posterUploader->moveToTMPFolder($files);
        }
    }

    /**
     * Upload file to defined target
     *
     * @param array | UploadedFile $files
     * @param string $targetDir
     * @return string
     */
    public function uploadFile($files, $targetDir)
    {
        if (is_array($files)) {
            foreach ($files as $file) {
                return $this->posterUploader->upload($file, $targetDir);
            }
        } else {
            return $this->posterUploader->upload($files, $targetDir);
        }
    }

    /**
     * Delete file by given URL
     *
     * @param string $file
     * @return boolean
     */
    public function deleteFile(string $file): bool
    {
        $file = $this->containerHelper->getParameter('public_folder') . $file;
        if ($this->isFile($file)) {
            $fileObject = new File($file);
            $fileWebp = str_replace($fileObject->guessExtension(), 'webp', $file);
            if ($this->isFile($fileWebp)) {
                unlink($fileWebp);
            }
            unlink($file);
            return true;
        }
        return false;
    }

    /**
     * Check if file exists by given url
     *
     * @param string $file
     * @return boolean
     */
    public function isFile(string $file)
    {
        if (file_exists($file)) {
            return true;
        } else {
            return false;
        }
    }
}
