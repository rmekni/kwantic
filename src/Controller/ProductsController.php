<?php

namespace App\Controller;

use App\Domain\Interface\ProductsDomainInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[Route(path: '/sub-category/{subCategoryId}/products', name: 'products_by_sub_category', methods: ['GET'], requirements: ['subCategoryId' => '\d+'])]
class ProductsController
{
    public function __construct(
        private Environment $templating,
        private ProductsDomainInterface $productsDomain
    ) {
    }

    public function __invoke(int $subCategoryId): Response
    {
        return new Response($this->templating->render('product/index.html.twig', $this->productsDomain->getProductsBySubCategory($subCategoryId)));
    }
}
