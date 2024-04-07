<?php

namespace App\Helper;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class SonataAdminPosterManager
{
    /**
     * Object hold the poster
     *
     * @var object
     */
    private $entity;

    /**
     * @var FileHelper
     */
    private $fileHelper;

    /**
     * @var string
     */
    private $property;

    /**
     * @var string
     */
    private $oldPoster;

    /**
     * @var UploadedFile[]
     */
    private $uploadedFiles;

    /**
     * @param FileHelper $fileHelper
     */
    public function __construct(FileHelper $fileHelper)
    {
        $this->fileHelper = $fileHelper;
    }

    /**
     * Update entity reference if has poster and poster exists
     * Dynamic method name goes here
     *
     * @param object $entity
     * @param string $property
     * @param Request $request
     *
     * @return void
     */
    public function managePosterProperty(object &$entity, Request $request, string $property = 'image', $oldPoster = null)
    {
        $this->entity = $entity;
        $this->oldPoster = $oldPoster;
        $this->property = $property;
        $this->uploadedFiles = $request->files->all();
        if ($this->checkEntityWithPoster() && $this->checkPosterUpdated()) {
            $newPoster = $this->uploadPoster();
            if ($newPoster) {
                $this->entity->{'set' . ucfirst($this->property)}($newPoster);
                $this->deletePoster($this->oldPoster);
            }
        }
    }

    /**
     * Delete poster
     *
     * @param object $entity
     * @param string $property
     * @return void
     */
    public function deleteObjectPoster($entity, string $property = 'poster')
    {
        $this->entity = $entity;
        $this->property = $property;
        if ($this->checkEntityWithPoster()) {
            $this->deletePoster($entity->{'get' . ucfirst($property)}());
        }
    }

    /**
     * Upload poster
     *
     * @return string
     */
    public function uploadPoster(): string
    {
        foreach ($this->uploadedFiles as $file) {
            if ($file[$this->property] instanceof UploadedFile) {
                return $this->fileHelper->uploadFile($file, $this->entity::UPLOAD_FOLDER);
            }
        }
        return false;
    }

    /**
     * Check if entity has poster property
     *
     * @return boolean
     */
    public function checkEntityWithPoster(): bool
    {
        return property_exists($this->entity, $this->property);
    }

    /**
     * Check if there is an uploaded picture
     *
     * @return boolean
     */
    public function checkPosterUpdated(): bool
    {
        return count($this->uploadedFiles) > 0;
    }

    /**
     * Delete old poster of the current object
     *
     * @return void
     */
    public function deletePoster($poster)
    {
        if ($poster) {
            $this->fileHelper->deleteFile($poster);
        }
    }
}
