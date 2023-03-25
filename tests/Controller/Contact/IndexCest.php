<?php


namespace App\Tests\Controller\Contact;

use App\Tests\ControllerTester;

class IndexCest
{
    public function _before(ControllerTester $I): void
    {
    }

    // tests
    public function tryAccessToFullList(ControllerTester $I): void
    {
        $I->amOnPage("/contact");
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle("Liste des contacts");
        $I->see("Liste des contacts", "h1");
        $I->seeNumberOfElements("//ul[@class='contacts']/li", 5);
    }

    public function tryAccessFirstContactAfterFullList(ControllerTester $I, int $searchID = 5): void
    {
        $this->tryAccessToFullList($I);

        $I->click("(//ul[@class='contacts']//li)[$searchID]");
        $I->amOnPage("/contact/$searchID");
        $I->seeCurrentRouteIs("app_contact_show", ["id" => $searchID]);
        $I->see("Ihuellou Maxime", "h1");
    }

    public function trySearchFunction(ControllerTester $I): void
    {
        $this->tryAccessToFullList($I);

        $I->fillField("//input[@name='search']", "Maxime");
        $I->click("//button[@type='submit']");
        $I->see("Maxime", "li");
        $I->click("//ul[@class='contacts']/li/a");
        $I->seeCurrentRouteIs("app_contact_show", ["id" => 5]);
        $I->see("Ihuellou Maxime", "h1");
    }
}
