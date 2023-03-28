<?php

namespace App\DataFixtures;

use App\Factory\CategoryFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $datas = json_decode(file_get_contents(__DIR__.'/data/Category.json'));

        foreach ($datas as $nameCategory) {
            $category = CategoryFactory::createOne(['name' => $nameCategory->name]);
        }
    }
}
