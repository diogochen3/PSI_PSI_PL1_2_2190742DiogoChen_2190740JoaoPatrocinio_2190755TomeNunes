<?php namespace backend\tests\functional;
use backend\tests\FunctionalTester;

class VerListadeMarcacoesCest
{
    public function CriarReceita(FunctionalTester $I)
    {
        $I->amOnPage('site/login');
        $I->see('Email');
        $I->fillField('#loginform-email' , 'aasdqweqweqwe@abc.com');
        $I->fillField('#loginform-password', '123456789');
        $I->click('Login');
        $I->amOnPage('site/table_marcacoes');
    }
}
