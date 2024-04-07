<?php

namespace App\Traits;

use App\Imagine\LiipImagineProcessor;

trait GetBlankImageTrait
{
    private function getBlankImage(LiipImagineProcessor $liipImagineProcessor, string $filter = '', string $image = '/img/no-image.png')
    {
        if ($filter) {
            return $liipImagineProcessor->getFilteredImage($image, $filter);
        }
    }
}
