<?php

namespace App\Helper;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileValidator
{
    public const MAX_IMG_SIZE = '4000';
    public const MAX_DOC_SIZE = '8000';
    public const MAX_VIDEO_SIZE = '4000';
    public const IMG_EXTS = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG'];
    public const DOC_EXTS = ['docs', 'docx', 'pdf', 'ppt', 'txt', 'xls', 'csv'];
    public const VID_EXTS = ['mp4, mov'];
    public const INVALID_EXTENSION = 'file_extension_error';
    public const INVALID_SIZE = 'file_size_exceeded';

    /**
     * Validate given file
     *
     * @param UploadedFile $file
     * @param string $fileType
     * @return boolean
     */
    public static function validateFile(UploadedFile $file, string $fileType): bool
    {
        $extension = $file->guessExtension();
        $size = $file->getSize();
        if (self::validateExtension($extension, $fileType)) {
            return self::INVALID_EXTENSION;
        }
        if (self::validateSize($size, $fileType)) {
            return self::INVALID_SIZE;
        }
        return true;
    }

    /**
     * Validate fila extensiion
     *
     * @param string $extension
     * @param string $fileType
     * @return boolean
     */
    private static function validateExtension(string $extension, string $fileType): bool
    {
        switch ($fileType) {
            case 'img':
                return in_array($extension, self::IMG_EXTS);
            case 'doc':
                return in_array($extension, self::DOC_EXTS);
            case 'video':
                return in_array($extension, self::VID_EXTS);
        }
    }

    /**
     * Validate file size
     *
     * @param float $fileSize
     * @param string $fileType
     * @return boolean
     */
    private static function validateSize(float $fileSize, string $fileType): bool
    {
        switch ($fileType) {
            case 'img':
                return $fileSize <= self::MAX_IMG_SIZE;
            case 'doc':
                return $fileSize <= self::MAX_DOC_SIZE;
            case 'video':
                return $fileSize <= self::MAX_VIDEO_SIZE;
        }
    }
}
