<?php

namespace App\Domain;

use App\Domain\Interface\IndexDomainInterface;
use App\Domain\ViewModel\CategoryViewModel;
use App\Repository\CategoryRepository;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class IndexDomain implements IndexDomainInterface
{
    public function __construct(
        private CategoryRepository $categoryRepository,
        private CategoryViewModel $categoryViewModel,
        private UrlGeneratorInterface $urlGenerator
    ) {
    }

    public function getIndexData(): array
    {
        return ['categories' => (function ($categories) {
            $categoriesList = [];
            foreach ($categories as $category) {
                $categoriesList[] = $this->categoryViewModel->fromCategory($category, $this->urlGenerator);
            }
            return $categoriesList;
        })($this->categoryRepository->getCategories())];
    }
}
