<?php

namespace App\Controller;

use App\Domain\Interface\IndexDomainInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[Route(path: '/', name: 'index', methods: ['GET'])]
class IndexController
{
    public function __construct(private Environment $templating, private IndexDomainInterface $indexDomain)
    {
    }

    public function __invoke(): Response
    {
        return new Response($this->templating->render('index/index.html.twig', $this->indexDomain->getIndexData()));
    }
}
