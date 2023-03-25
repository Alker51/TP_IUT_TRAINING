<?php

namespace App\DataFixtures;

use App\Factory\CategoryFactory;
use App\Factory\ContactFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $contacts = ContactFactory::createMany(4, function () {
            return ['category' => CategoryFactory::random()];
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
