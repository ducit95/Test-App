<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
      {
        $this->assertTrue(true);
      }
    public function testIndex()
    {
        $response = $this->call('GET', '/');
        $this->see('LIst User');
        $this->assertEquals(200, $response->status());
        $this->assertResponseOk();
    }
    public function testCreateUSer(){
      $response = $this->call('POST', 'create',['name' => 'Taylor','address' =>'HA NOI','age'=>6]);
      $this->assertResponseOk();
      $this->seeInDatabase('test_app_user', ['name' => 'Taylor','name' => 'Taylor','address' =>'HA NOI','age'=>6]);
    }
    public function testVali_name_User_CreateUSer(){
      $response = $this->call('POST', 'create',['name' => '','address' =>'kaka','age'=>6]);
      $this->assertResponseOk();
      $this->notSeeInDatabase('test_app_user', ['address' => 'kaka']);
    }
    public function testVali_address_CreateUSer(){
      $response = $this->call('POST', 'create',['name' => 'kaka','address' =>'','age'=>6]);
      $this->assertResponseOk();
      $this->notSeeInDatabase('test_app_user', ['name' => 'kaka']);
    }
    public function testVali_age_CreateUSer(){
      $response = $this->call('POST', 'create',['name' => 'kaka','address' =>'HA NOI','age'=>'']);
      $this->assertResponseOk();
      $this->notSeeInDatabase('test_app_user', ['name' => 'kaka']);
    }
    public function testVali_name_address_CreateUSer(){
      $response = $this->call('POST', 'create',['name' => '','address' =>'','age'=>99]);
      $this->assertResponseOk();
      $this->notSeeInDatabase('test_app_user', ['age' => '99']);
    }
    public function testVali_address_age_CreateUSer(){
      $response = $this->call('POST', 'create',['name' => 'kaka','address' =>'','age'=>'']);
      $this->assertResponseOk();
      $this->notSeeInDatabase('test_app_user', ['name' => 'kaka']);
    }
    public function testVali_name_age_CreateUSer(){
      $response = $this->call('POST', 'create',['name' => '','address' =>'kaka','age'=>'']);
      $this->assertResponseOk();
      $this->notSeeInDatabase('test_app_user', ['address' => 'kaka']);
    }
    public function testVali_all_CreateUSer(){
      $response = $this->call('POST', 'create',['name' => '','address' =>'','age'=>'']);
       $this->assertFalse(false);
    }
     public function testEdit(){
      $response = $this->call('POST', 'update/92',['name' => 'Taylor92','address' =>'HA NOI','age'=>6]);
      $this->assertResponseOk();
      $this->seeInDatabase('test_app_user', ['id' => 92,'name' => 'Taylor92','address' =>'HA NOI','age'=>6]);
    }
    public function testVali_name_User_Edit(){
      $response = $this->call('POST', 'update/92',['name' => '','address' =>'kaka','age'=>6]);
      $this->assertResponseOk();
      $this->notSeeInDatabase('test_app_user', ['id'=>92,'address' => 'kaka']);
    }
    public function testVali_address_Edit(){
      $response = $this->call('POST', 'update/92',['name' => 'kaka','address' =>'','age'=>6]);
      $this->assertResponseOk();
      $this->notSeeInDatabase('test_app_user', ['id'=>92,'name' => 'kaka']);
    }
    public function testVali_age_Edit(){
      $response = $this->call('POST', 'update/92',['name' => 'kaka','address' =>'HA NOI','age'=>'']);
      $this->assertResponseOk();
      $this->notSeeInDatabase('test_app_user', ['id'=>92,'name' => 'kaka']);
    }
    public function testVali_name_address_Edit(){
      $response = $this->call('POST', 'update/92',['name' => '','address' =>'','age'=>99]);
      $this->assertResponseOk();
      $this->notSeeInDatabase('test_app_user', ['id'=>92,'age' => '99']);
    }
    public function testVali_address_age_Edit(){
      $response = $this->call('POST', 'update/92',['name' => 'kaka','address' =>'','age'=>'']);
      $this->assertResponseOk();
      $this->notSeeInDatabase('test_app_user', ['id'=>92,'name' => 'kaka']);
    }
    public function testVali_name_age_Edit(){
      $response = $this->call('POST', 'update/92',['name' => '','address' =>'kaka','age'=>'']);
      $this->assertResponseOk();
      $this->notSeeInDatabase('test_app_user', ['id'=>92,'address' => 'kaka']);
    }
    public function testVali_all_Edit(){
      $response = $this->call('POST', 'update/92',['id'=>92,'name' => '','address' =>'','age'=>'']);
       $this->assertFalse(false);
    }
    public function testDetete(){
      $response = $this->call('GET', 'detele/96',[]);
      $this->notSeeInDatabase('test_app_user', ['id'=>96]);
    }
}
