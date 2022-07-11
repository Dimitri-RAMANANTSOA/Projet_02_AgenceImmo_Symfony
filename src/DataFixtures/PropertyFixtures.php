<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Property;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for($i = 0; $i < 100; $i++)
        {
           $property = new Property();
           $property
           ->setTitle($faker->words(3, true))
           ->setDescription($faker->sentence(3))
           ->setSurface($faker->numberBetween(20, 350))
           ->setRooms($faker->numberBetween(1, 9))
           ->setBedroom($faker->numberBetween(1, 8))
           ->setFloor($faker->numberBetween(0, 15))
           ->setPrice($faker->numberBetween(50000, 1000000))
           ->setHeat($faker->numberBetween(0, count(Property::HEAT)-1))
           ->setCity($faker->city())
           ->setAddress($faker->streetAddress())
           ->setPostalCode($faker->randomNumber(5, true))
           ->setSold(false);

           $manager->persist($property);
        }

        $manager->flush();
    }
}
