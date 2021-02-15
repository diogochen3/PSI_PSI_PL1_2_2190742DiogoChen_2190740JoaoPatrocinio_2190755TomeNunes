<?php namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;

class EditarPerfilCest
{
    public function EditarPerfil(FunctionalTester $I)
    {
        $I->amOnPage('site/login');
        $I->see('Email');
        $I->fillField('#loginform-email' , '123e21qe1e@sqe.sadq');
        $I->fillField('#loginform-password', '123456789');
        $I->click('Login');
        $I->amOnPage('profile/view');
        $I->click('Update');
        $I->fillField('First Name', 'ambrosio');
        $I->click('Save');
    }
}
