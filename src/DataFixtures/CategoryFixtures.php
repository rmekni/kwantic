<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture
{
    private array $references = [];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 3; $i++) {
            $category = new Category();
            $category->setName($faker->word);
            $manager->persist($category);
            $this->references[] = $category;
        }

        $manager->flush();

        /**
         * @var Category
         */
        foreach ($this->references as $key => $category) {
            $this->addReference('category-' . $key, $category);
        }
    }
}
