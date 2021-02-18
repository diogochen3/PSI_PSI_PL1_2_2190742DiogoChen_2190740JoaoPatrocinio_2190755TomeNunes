<?php namespace backend\tests\functional;
use backend\tests\FunctionalTester;

class CriarMedicoCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function CriarMedico(FunctionalTester $I)
    {
        $I->amOnPage('site/login');
        $I->see('Email');
        $I->fillField('#loginform-email' , 'aasdqweqweqwe@abc.com');
        $I->fillField('#loginform-password', '123456789');
        $I->click('Login');
        $I->amOnPage('site/signup');
        $I->fillField('Primeiro Nome', 'teste do nome');
        $I->fillField('Ultimo Nome', 'teste da ultimo nome');
        $I->fillField('Endereço de email', 'teste@do.com');
        $I->fillField('Morada', 'teste da morada');
        $I->fillField('Codigo Postal', '2440');
        $I->fillField('Numero de Identificação Fiscal', '2399238');
        $I->fillField('Numero de Telefone', '969238472');
        $I->fillField('Data de Nascimento', '15/12/2000');
        $I->selectOption('Genero', 'Male');
        $I->checkOption('SignupForm[id_especialidade][]');
        $I->fillField('Password', '123456789');
        $I->click('Signup');
    }
}
