<?php

namespace App\Twig\Extension;

use App\Helper\ContainerHelper;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class FileFunctionsExtension extends AbstractExtension
{

    /**
     * @param ContainerHelper $containerHelper
     */
    public function __construct(
        private ContainerHelper $containerHelper,
    ) {
    }

    /**
     * Get the function
     *
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('file_exists', [$this, 'fileExists']),
        ];
    }

    /**
     * Check if file exists
     *
     * @param string $file
     *
     * @return boolean
     */
    public function fileExists(string $file): bool
    {
        return file_exists($this->containerHelper->getParameter('public_folder') . $file) || file_exists($this->getRelativePath($file));
    }

    /**
     * Get relative path image
     *
     * @param string $originalImagePath
     *
     * @return string
     */
    private function getRelativePath($originalImagePath)
    {
        if (strpos($originalImagePath, '/media')) {
            $path = explode('/media', $originalImagePath);
            return 'media' . $path[1];
        }
        return $originalImagePath;
    }
}
