<?php

namespace App\Domain;

use App\Domain\Interface\SubCategoriesDomainInterface;
use App\Domain\ViewModel\SubCategoryViewModel;
use App\Repository\SubCategoryRepository;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SubCategoriesDomain implements SubCategoriesDomainInterface
{
    public function __construct(
        private SubCategoryRepository $subCategoryRepository,
        private SubCategoryViewModel $subCategoryViewModel,
        private UrlGeneratorInterface $urlGenerator
    ) {
    }

    public function getSubCategoriesByCategory(int $categoryId): ?array
    {
        return ['sub_categories' => (function ($subcategories) {
            $subcategoriesList = [];
            foreach ($subcategories as $subCategory) {
                $subcategoriesList[] = $this->subCategoryViewModel->fromSubCategory($subCategory, $this->urlGenerator);
            }
            return $subcategoriesList;
        })($this->subCategoryRepository->getSubCategoriesByCategory($categoryId))];
    }
}
