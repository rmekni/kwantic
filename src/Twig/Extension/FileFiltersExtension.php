<?php

namespace App\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class FileFiltersExtension extends AbstractExtension
{
    /**
     * Get the function
     *
     * @return array
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('file_extension', [$this, 'fileExtension'])
        ];
    }

    /**
     * Get File extension
     *
     * @param string $file
     * @return string
     */
    public function fileExtension(string $file): string
    {
        return pathinfo($file, PATHINFO_EXTENSION);
    }
}
