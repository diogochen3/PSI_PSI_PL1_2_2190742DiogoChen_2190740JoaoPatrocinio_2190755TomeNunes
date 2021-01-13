<?php namespace backend\tests\functional;
use backend\tests\FunctionalTester;

class CriarReceitasCest
{
    public function CriarReceita(FunctionalTester $I)
    {
        $I->amOnPage('site/login');
        $I->see('Email');
        $I->fillField('#loginform-email' , 'tome.nunes902@gmail.com');
        $I->fillField('#loginform-password', '1234567890');
        $I->click('Login');
        $I->amOnPage('receitas/create');
        $I->fillField('Nome Medicamento', 'varfine');
        $I->fillField('Quantidade', '1');
        $I->click('Save');
    }
}
