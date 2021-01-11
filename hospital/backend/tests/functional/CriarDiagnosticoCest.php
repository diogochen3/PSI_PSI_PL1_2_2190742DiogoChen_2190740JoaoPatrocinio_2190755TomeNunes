<?php namespace backend\tests\functional;
use backend\tests\FunctionalTester;

class CriarDiagnosticoCest
{
public function CriarDiagnostico(FunctionalTester $I){
    $I->amOnPage('site/login');
    $I->see('Email');
    $I->fillField('#loginform-email' , 'tome.nunes902@gmail.com');
    $I->fillField('#loginform-password', '1234567890');
    $I->click('Login');
    $I->amOnPage('diagnostico/create');
    $I->fillField('Descricao', 'teste da descricao');
    $I->fillField('Date', '12-12-2021');
    $I->fillField('Situacao', 'teste da situaçao');
    $I->selectOption('Id Utente', '13');
    $I->click('Save');
}
}
