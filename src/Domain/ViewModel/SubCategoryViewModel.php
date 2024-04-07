<?php

namespace App\Domain\ViewModel;

use App\Imagine\LiipImagineProcessor;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SubCategoryViewModel
{
    public function __construct(
        private LiipImagineProcessor $liipImagineProcessor,
        private UrlGeneratorInterface $urlGenerator
    ) {
    }
    public function fromSubCategory(array $subCategory,): array
    {
        return [
            'id'          => $subCategory['id'],
            'name'        => $subCategory['name'],
            'image'       => $this->liipImagineProcessor->getFilteredImage($subCategory['image'], 'vign_image'),
            'productsUrl' => $this->urlGenerator->generate('products_by_sub_category', ['subCategoryId' => $subCategory['id']])
        ];
    }
}
