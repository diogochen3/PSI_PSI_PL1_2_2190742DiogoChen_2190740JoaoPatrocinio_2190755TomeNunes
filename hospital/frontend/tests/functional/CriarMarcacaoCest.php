<?php namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;

class CriarMarcacaoCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {

    }
    public function CriarMarcacao(FunctionalTester $I)
    {
        $I->amOnPage('site/login');
        $I->see('Email');
        $I->fillField('#loginform-email' , 'abcdefgh@abc.com');
        $I->fillField('#loginform-password', '123456789');
        $I->click('Login');
        $I->amOnPage('marcacao/create');
        $I->selectOption('Especialidade', '3');
        $I->selectOption('Médico', '64');
        $I->selectOption('tempo', '10');
        $I->click('Save');
    }


}
