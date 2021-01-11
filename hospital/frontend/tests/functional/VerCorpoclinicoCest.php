<?php namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;

class VerCorpoclinicoCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
    }
    public function VerCorpoclinico(FunctionalTester $I){
        $I->amOnRoute('site/about');
        $I->see('Nome', 'th');
    }
}
