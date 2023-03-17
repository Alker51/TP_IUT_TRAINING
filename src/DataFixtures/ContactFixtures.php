<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\ContactFactory;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $contacts = ContactFactory::createMany(4);
        $contacts = ContactFactory::createOne([
            'firstName' => 'Maxime',
            'lastName' =>'Ihuellou',
            'email' => 'Maxime.Ihuellou@gmail.gl'
        ]);
    }
}
