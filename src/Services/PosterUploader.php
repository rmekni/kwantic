<?php

namespace App\Services;

use App\Helper\ContainerHelper;
use App\Helper\FileValidator;
use App\Helper\RandomHelper;
use App\Services\Interfaces\PosterUploaderInterface;
use App\Traits\TextUnicode;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Filesystem;

class PosterUploader implements PosterUploaderInterface
{
    use TextUnicode;

    /**
     * @var string
     */
    private $targetDir;

    /**
     * @var string
     */
    private $_path = 'uploads/';

    /**
     * @var string
     */
    private $_target;

    /**
     * @var RandomHelper
     */
    private $randomHelper;

    /**
     * @var ContainerHelper
     */
    private $containerHelper;

    /**
     * @var FileValidator
     */
    private $fileValidator;

    /**
     * @var TranslationHelper
     */
    private $translationHelper;

    /**
     * FileValidator
     *
     * @param RandomHelper $randomHelper
     * @param ContainerHelper $containerHelper
     * @param FileValidator $fileValidator
     */
    public function __construct(
        RandomHelper $randomHelper,
        ContainerHelper $containerHelper,
        FileValidator $fileValidator,
    ) {
        $this->randomHelper = $randomHelper;
        $this->containerHelper = $containerHelper;
        $this->fileValidator = $fileValidator;
    }


    /**
     * Upload given file in given directory
     *
     * @param UploadedFile $file
     * @param string $targetDir
     * @param string $type
     * @return string
     */
    public function upload(UploadedFile $file, string $targetDir, string $type = 'img'): string
    {
        $this->targetDir = $this->_path . $targetDir;
        $this->_target = $targetDir;

        if ($this->fileValidator->validateFile($file, $type)) {
            $extension = $file->getClientOriginalExtension();
            $originalFileName = $file->getClientOriginalName();
            $fileName =  str_replace('.' . $extension, '', $originalFileName);
            $fileName = $this->makeSlug($fileName) . '-' . $this->randomHelper->generateRandomString('4') . '.' . $extension;
            $file->move($this->targetDir, $fileName);
            $imageFullName = '/' . $this->_path .  $this->_target . '/' . $fileName;
            return $imageFullName;
        }

        return false;
    }

    /**
     * Move temporary file to specific directory
     *
     * @param UploadedFile $file
     * @return string
     */
    public function moveToTMPFolder(UploadedFile $file): string
    {
        $filesSystem = new Filesystem();
        $filesSystem->copy($file->getPathname(), $this->containerHelper->getParameter('APP_TEMP_FOLDER') . $file->getFileName());
        return $file->getFileName();
    }
}
