<?php namespace frontend\tests\acceptance;
use frontend\tests\AcceptanceTester;

class marcarcaocCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
    }
    public function marcacao(AcceptanceTester $I){

        $I->amOnPage('index.php/site/signup');

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
        $I->wait(5);
        $I->amOnPage('index.php/site/login');
        $I->see('Email');

        $I->wait(5);

        $I->fillField('#loginform-email' , 'ambrosio1.nunes@gmail.com');
        $I->fillField('#loginform-password', '1234567890');

        $I->wait(5);
        $I->click('Login');
        $I->wait(5);

        $I->amOnPage('index.php/marcacao/create');
        $I->selectOption('Especialidade', '2');
        $I->wait(5);
        $I->selectOption('Médico', '64');
        $I->wait(5);
        $I->selectOption('tempo', '2');
        $I->wait(10);

        $I->click('Save');

    }
}
