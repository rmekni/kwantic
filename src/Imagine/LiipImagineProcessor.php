<?php

namespace App\Imagine;

use App\Helper\ContainerHelper;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Liip\ImagineBundle\Imagine\Data\DataManager;
use Liip\ImagineBundle\Imagine\Filter\FilterManager;

class LiipImagineProcessor
{
    public function __construct(
        private CacheManager $cacheManager,
        private DataManager $dataManager,
        private FilterManager $filterManager,
        private ContainerHelper $containerHelper
    ) {
    }

    /**
     * Edit picture depending on given filter
     *
     * @param string $path
     * @param string $filter
     * @param array $filterParam
     * @return string
     */
    public function getImagePath(string $path, string $filter): ?string
    {
        return $this->cacheManager->getBrowserPath($path, $filter);
    }

    /**
     * Edit picture depending on given filter
     *
     * @param string $imagePath
     * @param string $filter
     * @param array $filterParam
     * @return string
     */
    public function getFilteredImage(string $imagePath, string $filter): string
    {
        if (!$this->cacheManager->isStored($imagePath, $filter) && file_exists($this->containerHelper->getParameter('public_folder') . $imagePath)) {
            $this->filterImage($imagePath, $filter);
            return $this->cacheManager->getBrowserPath($imagePath, $filter);
        } elseif ($this->cacheManager->isStored($imagePath, $filter)) {
            return $this->cacheManager->getBrowserPath($imagePath, $filter);
        }
        return '';
    }

    /**
     * Undocumented function
     *
     * @param string $imagePath
     * @param string $filter
     * @return string
     */
    public function filterImage(string $imagePath, string $filter): string
    {
        if (!$this->cacheManager->isStored($imagePath, $filter)) {
            $binary = $this->dataManager->find($filter, $imagePath);
            $binary = $this->filterManager->applyFilter($binary, $filter);
            $this->cacheManager->store($binary, $imagePath, $filter);
        }

        return $this->cacheManager->getBrowserPath($imagePath, $filter);
    }
}
