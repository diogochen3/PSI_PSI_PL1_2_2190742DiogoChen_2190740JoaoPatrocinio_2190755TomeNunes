<?php namespace frontend\tests\acceptance;
use frontend\tests\AcceptanceTester;

class ProfileCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
    }
    public function UpdateProfile(AcceptanceTester $I){
        $I->amOnPage('index.php/site/signup');
        $I->see('Registar', 'h2');
        $I->fillField('Primeiro Nome', 'ambrosio');
        $I->fillField('Ultimo Nome', 'nunes');
        $I->fillField('Endereço de email', 'ambrosio1.nunes@gmail.com');
        $I->fillField('Morada', 'rua das ruas');
        $I->fillField('Codigo Postal', '2440');
        $I->fillField('Numero de Identificação Fiscal', '14');
        $I->selectOption('Genero', 'Male');
        $I->fillField('Numero de Telefone', '969422799');
        $I->fillField('Data de Nascimento', '10-10-2000');
        $I->fillField('Password', '1234567890');
        $I->click('Signup');
        $I->see('Bem-Vindo', 'h2');
        $I->amOnPage('index.php/site/login');
        $I->see('Email');
        $I->fillField('#loginform-email' , 'ambrosio1.nunes@gmail.com');
        $I->fillField('#loginform-password', '1234567890');
        $I->click('Login');
        $I->amOnPage('index.php/profile/view');
        $I->see('Update');
        $I->click('Update');
        $I->see('First Name');
        $I->fillField('First Name', 'josé');

        $I->click('Save');

    }
}
