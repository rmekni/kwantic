<?php

namespace App\Domain;

use App\Domain\Interface\ProductsDomainInterface;
use App\Domain\ViewModel\ProductViewModel;
use App\Repository\ProductRepository;

class ProductsDomain implements ProductsDomainInterface
{
    public function __construct(
        private ProductRepository $productRepository,
        private ProductViewModel $productViewModel
    ) {
    }

    public function getProductsBySubCategory(int $subCategoryId): ?array
    {
        return ['products' => (function ($products) {
            $productsList = [];
            foreach ($products as $product) {
                $productsList[] = $this->productViewModel->fromProduct($product);
            }
            return $productsList;
        })($this->productRepository->getProductsBySubCategory($subCategoryId))];
    }
}
