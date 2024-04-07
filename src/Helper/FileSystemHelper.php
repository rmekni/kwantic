<?php

namespace App\Helper;

use App\Services\WebpImage;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

class FileSystemHelper
{
  /**
   * Copy image from disk
   *
   * @param string $image
   * @return string
   */
    public function copyImage(string $image): string
    {
        $image = substr($image, 1);
        $fileSystem = new Filesystem();
        $imageFile = new File($image);
        $randomCopy = '-copy' . bin2hex(random_bytes(3));
        $imageRealPath = str_replace('.' . $imageFile->guessExtension(), $randomCopy, $imageFile->getRealPath());
        $imageOrigin = $imageRealPath . '.' . $imageFile->guessExtension();
        if ($imageFile) {
            $fileSystem->copy($imageFile->getRealPath(), $imageOrigin);
            return '/' . str_replace('.' . $imageFile->guessExtension(), $randomCopy . '.' . $imageFile->guessExtension(), $imageFile->getPathName());
        }
    }
}
