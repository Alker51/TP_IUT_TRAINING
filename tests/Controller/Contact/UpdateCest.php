<?php

namespace App\Tests\Controller\Contact;

use App\Factory\ContactFactory;
use App\Tests\ControllerTester;

class UpdateCest
{
    public function form(ControllerTester $I): void
    {
        ContactFactory::createOne([
            'firstname' => 'Homer',
            'lastname' => 'Simpson',
            'phone' => '0102030405',
            'email' => 'h.Simpson@spring.field'
        ]);

        $I->amOnPage('/contact/1/update');

        $I->seeInTitle('Édition de Simpson, Homer');
        $I->see('Édition de Simpson, Homer', 'h1');
    }
}