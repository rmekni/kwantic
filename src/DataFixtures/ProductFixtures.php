<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 9; $i++) {
            $subCategory = $this->getReference('subcategory-' . $i);
            for ($j = 0; $j < 3; $j++) {
                $product = new Product();
                $product->setName($faker->word);
                $product->setSpecifications('test');
                $product->setImage($j % 2 == 0 ? '/uploads/product-fixtures/pelles.jpg' : '/uploads/product-fixtures/compacteur.jpeg');
                $product->setSubCategory($subCategory);

                $manager->persist($product);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SubCategoryFixtures::class,
        ];
    }
}
