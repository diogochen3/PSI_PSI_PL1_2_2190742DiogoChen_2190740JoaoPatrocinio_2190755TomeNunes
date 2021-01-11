<?php namespace common\tests;

use common\models\Profile;

class profileTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {

    }

    public function testProfile(){

        $profile = new Profile();
        $profile->First_name= "pato";
        $profile->Last_name= "ganso";
        $profile->NIF= "220032320";
        $profile->Address= "rua dos patos";
        $profile->Email= "pato.ganso@gmail.com";
        $profile->Phone_number= "923456344";
        $profile->postal_code= "2440";
        $profile->Birth_date= "	2000-01-04";
        $profile->gender= "Male";
        $profile->id= "8";
        $profile->save();


        $this->tester->seeRecord('common\models\profile', ['First_name' => 'pato',
            'Last_name' => 'ganso' ,
            'NIF' => '220032320',
            'id' => '8',
            'Address' => 'rua dos patos',
            'Email' => 'pato.ganso@gmail.com',
            'Phone_number' => '923456344',
            'postal_code' => '2440',
            'Birth_date' => '2000-01-04',
            'gender' => 'Male']);

        // $this->tester->dontSeeRecord('common\models\profile', ['First_name' => 'pato','Last_name' => 'ganso' ,'NIF' => '220032320','Address' => 'rua dos patos','Email' => 'pato.ganso@gmail.com','Phone_number' => '923456344','postal_code' => '2440','Birth_date' => '2000-01-04','gender' => 'Male']);

    }
}