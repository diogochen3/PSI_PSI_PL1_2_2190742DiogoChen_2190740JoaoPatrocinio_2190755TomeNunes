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
        $I->fillField('#loginform-email' , '123e21qe1e@sqe.sadq');
        $I->fillField('#loginform-password', '123456789');
        $I->click('Login');
        $I->amOnPage('marcacao/create');
        $I->fillField('Date', '24-12-2020');
        $I->fillField('Tempo', '20:20');
        $I->selectOption('Id Especialidade', '2');
        $I->selectOption('Id Medico', '18');
        $I->click('Save');
    }


}
