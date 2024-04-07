<?php

namespace App\Domain\Interface;

interface SubCategoriesDomainInterface
{
    public function getSubCategoriesByCategory(int $categoryId): ?array;
}
