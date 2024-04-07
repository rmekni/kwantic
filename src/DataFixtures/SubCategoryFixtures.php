<?php

namespace App\DataFixtures;

use App\Entity\SubCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SubCategoryFixtures extends Fixture implements DependentFixtureInterface
{
    private array $references = [];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 9; $i++) {
            $subCategory = new SubCategory();
            $subCategory->setName($faker->word);
            $subCategory->setImage($i % 2 == 0 ? '/uploads/sub-category-fixtures/pelles.jpg' : '/uploads/sub-category-fixtures/compacteur.jpeg');
            $subCategory->setCategory($this->getCategoryReference($i));

            $manager->persist($subCategory);
            $this->references[] = $subCategory;
        }

        $manager->flush();

        /**
         * @var SubCategory
         */
        foreach ($this->references as $key => $subCategory) {
            $this->addReference('subcategory-' . $key, $subCategory);
        }
    }

    private function getCategoryReference(int $i)
    {
        switch ($i) {
            case $i < 3:
                return $this->getReference('category-0');
            case $i < 6:
                return $this->getReference('category-1');
            default:
                return $this->getReference('category-2');
        }
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
