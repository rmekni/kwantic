<?php

namespace App\Domain\ViewModel;

use App\Entity\Category;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CategoryViewModel
{
    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }

    public function fromCategory(array $category): array
    {
        return [
            'id'               => $category['id'],
            'name'             => $category['name'],
            'subCategoriesUrl' => $this->urlGenerator->generate('sub_categories_by_category', ['categoryId' => $category['id']])
        ];
    }
}
