<?php

namespace App\DataFixtures;

use App\Entity\Product;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 1; $i <= 20; $i++) {
            $product = (new Product())
                ->setName('product ' . $i)
                ->setUnitPrice(mt_rand(10, 100))
                ->setCreatedAt(new DateTime());

            $manager->persist($product);

            //product tax
            $countries = ['FIN', 'SWE', 'POL', 'EST'];
            foreach ($countries as $country) {
                $productTax = (new Product\Tax())
                    ->setCountry($country)
                    ->setProduct($product)
                    ->setPercentage(mt_rand(10, 40))
                    ->setCreatedAt(new DateTime());

                $manager->persist($productTax);
            }
        }

        $manager->flush();
    }
}
