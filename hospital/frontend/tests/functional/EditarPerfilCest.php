<?php namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;

class EditarPerfilCest
{
    public function EditarPerfil(FunctionalTester $I)
    {
        $I->amOnPage('site/login');
        $I->see('Email');
        $I->fillField('#loginform-email' , 'tome.nunes902@gmail.com');
        $I->fillField('#loginform-password', '1234567890');
        $I->click('Login');
        $I->amOnPage('profile/view');
        $I->click('Update');
        $I->fillField('First Name', 'ambrosio');
        $I->click('Save');
    }
}
