<?php

namespace App\Helper;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ContainerHelper
{
    public function __construct(
        private ParameterBagInterface $parameterBag
    ) {
    }

    /**
     * Get Parameter from container bag
     *
     * @param string $parameter
     * @return mixed
     */
    public function getParameter($parameter)
    {
        return $this->parameterBag->get($parameter);
    }
}
