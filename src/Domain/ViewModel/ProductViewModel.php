<?php

namespace App\Domain\ViewModel;

use App\Entity\Product;
use App\Imagine\LiipImagineProcessor;

class ProductViewModel
{
    public function __construct(
        private LiipImagineProcessor $liipImagineProcessor
    ) {
    }

    public function fromProduct(Product $product): array
    {
        return [
            'id'            => $product->getId(),
            'name'          => $product->getName(),
            'specification' => $product->getSpecifications(),
            'image'         => $this->liipImagineProcessor->getFilteredImage($product->getImage(), 'vign_image')
        ];
    }
}
