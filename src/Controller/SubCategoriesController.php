<?php

namespace App\Controller;

use App\Domain\Interface\SubCategoriesDomainInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/category/{categoryId}/subcategories', name: 'sub_categories_by_category', methods: ['GET'], requirements: ['categoryId' => '\d+'])]
class SubCategoriesController
{
    public function __construct(
        private SubCategoriesDomainInterface $subCategoriesDomain
    ) {
    }

    public function __invoke(int $categoryId): JsonResponse
    {
        return new JsonResponse($this->subCategoriesDomain->getSubCategoriesByCategory($categoryId));
    }
}
