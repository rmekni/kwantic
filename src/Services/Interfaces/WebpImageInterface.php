<?php

namespace App\Services\Interfaces;

interface WebpImageInterface
{
  /**
   * Create and return image
   *
   * @param string $originalImagePath
   * @return string
   */
    public function getWebpImage(string $originalImagePath): string;

    /**
     * Make the webp
     *
     * @param string $originalImagePath
     * @return void
     */
    public function generateWebpImage(string $originalImagePath): void;
}
