<?php

namespace App\Domain\Interface;

interface ProductsDomainInterface
{
    public function getProductsBySubCategory(int $subCategoryId): ?array;
}
