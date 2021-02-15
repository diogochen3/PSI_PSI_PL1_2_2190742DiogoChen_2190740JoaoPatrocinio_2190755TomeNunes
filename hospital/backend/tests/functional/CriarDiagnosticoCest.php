<?php namespace backend\tests\functional;
use backend\tests\FunctionalTester;

class CriarDiagnosticoCest
{
public function CriarDiagnostico(FunctionalTester $I){
    $I->amOnPage('site/login');
    $I->see('Email');
    $I->fillField('#loginform-email' , 'aasdqweqweqwe@abc.com');
    $I->fillField('#loginform-password', '123456789');
    $I->click('Login');
    $I->amOnPage('diagnostico/create');
    $I->fillField('Descricao', 'teste da descricao');
    $I->fillField('Situacao', 'teste da situaçao');
    $I->selectOption('Id Utente', '36');
    $I->click('Save');
}
}
