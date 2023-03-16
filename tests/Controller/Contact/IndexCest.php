<?php


namespace App\Tests\Controller\Contact;

use App\Tests\ControllerTester;

class IndexCest
{
    public function _before(ControllerTester $I)
    {
    }

    // tests
    public function tryAccessToFullList(ControllerTester $I)
    {
        $I->amOnPage('/contact');
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle('Liste des contacts');
        $I->see('Liste des contacts', 'h1');
        $I->seeNumberOfElements('li', 195);
    }

    public function tryAccessFirstContact(ControllerTester $I)
    {
        $I->amOnPage('/contact');
        $I->seeResponseCodeIsSuccessful();
        $I->click('(//li)[1]');
        $I->amOnPage('/contact/1');
        $I->seeCurrentRouteIs('app_contact_show', ['id' => 1]);
    }
}
