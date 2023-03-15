<?php


namespace App\Tests\Controller\Contact;

use App\Tests\ControllerTester;

class IndexCest
{
    public function _before(ControllerTester $I)
    {
    }

    // tests
    public function tryToTest(ControllerTester $I)
    {
        $I->amOnPage('/contact');
        $I->seeResponseCodeIsSuccessful();
        // $I->seeNumberOfElements('li', 195);
    }
}
