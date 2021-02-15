<?php namespace backend\tests\functional;
use backend\tests\FunctionalTester;

class UpdateUtenteCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function UpdateUtente(FunctionalTester $I)
    {
        $I->amOnPage('site/login');
        $I->see('Email');
        $I->fillField('#loginform-email' , 'aasdqweqweqwe@abc.com');
        $I->fillField('#loginform-password', '123456789');
        $I->click('Login');
        $I->amOnPage('site/table');
        $I->click('Update');
        $I->fillField('First Name', 'Toni');
        $I->click('Save');
    }
}
