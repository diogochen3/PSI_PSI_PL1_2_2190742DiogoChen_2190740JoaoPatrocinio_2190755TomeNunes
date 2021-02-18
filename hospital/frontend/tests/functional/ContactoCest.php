<?php namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;

class ContactoCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function contacto(FunctionalTester $I)
    {
        $I->amOnPage('site/login');
        $I->see('Email');
        $I->fillField('#loginform-email' , 'abcdefgh@abc.com');
        $I->fillField('#loginform-password', '123456789');
        $I->click('Login');
        $I->amOnPage('site/contact');
        $I->fillField('Name', 'ambrosio');
        $I->selectOption('Id Categoria', '2');
        $I->fillField('Email', 'ambrosio@gmail.com');
        $I->fillField('Subject', 'teste do subject');
        $I->fillField('Body', 'teste do body');
        $I->click('Submit');
    }
}
