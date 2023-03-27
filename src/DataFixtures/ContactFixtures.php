<?php

namespace App\DataFixtures;

use App\Factory\CategoryFactory;
use App\Factory\ContactFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $contacts = ContactFactory::createMany(400, function () {
            $faker = Factory::create();
            if ($faker->boolean(90)) {
                return ['category' => CategoryFactory::random()];
            }
            else
            {
                return ['category' => null];
            }
        });

        $contacts = ContactFactory::createOne([
            'firstName' => 'Maxime',
            'lastName' => 'Ihuellou',
            'email' => 'Maxime.Ihuellou@gmail.gl',
            'category' => CategoryFactory::random()
        ]);
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
