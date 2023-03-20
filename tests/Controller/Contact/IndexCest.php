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
        $I->seeNumberOfElements('li', 5);
    }

    public function tryAccessFirstContact(ControllerTester $I)
    {
        $this->tryAccessToFullList($I);

        $idClick = 5;

        $I->click("(//li)[$idClick]");
        $I->amOnPage("/contact/$idClick");
        $I->seeCurrentRouteIs('app_contact_show', ['id' => $idClick]);
        $I->see('Ihuellou Maxime', 'h1');
    }
}
