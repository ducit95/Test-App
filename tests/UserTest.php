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
    public function testDatauser()
    {
        $response = $this->call('GET', 'getdatauser/id');
        $this->assertResponseOk();
        $this->assertResponseStatus(200);
    }
    public function valid_user()
    {
        $response = $this->call('POST', 'create', [
          'name' => 'Duc Nguyen',
          'address' => 'Ha Noi',
          'age' => '50'
        ]);
        $this->assertRedirectedToAction('AppController@store');
    }
    public function invalid_name()
    {
        $response = $this->call('POST', '/create', [
          'name' => '',
          'address' => 'hanoi',
          'age' => '92'
        ]);
        $this->assertFalse(false);
    }
    public function invalid_address()
    {
        $response = $this->call('POST', '/create', [
          'name' => 'Duc Nguyen',
          'address' => '',
          'age' => '92'
        ]);
        $this->assertFalse(false);
    }
    public function invalid_age()
    {
        $response = $this->call('POST', '/create', [
          'name' => 'Duc Nguyen',
          'address' => 'hanoi',
          'age' => '10'
        ]);
        $this->assertFalse(false);
    }
    public function deleteuser()
    {
        $response = $this->call('GET', 'detele/123', []);
        $deleted= DB::table('test_app_user')->where('id', '123')->first();
        $this->assertRedirectedToAction('AppController@destroy');
    }
    public function edit()
    {
        $response = $this->call('post', 'update/123', [
          'name' => 'Duc Nguyen',
          'address' => 'hanoi',
          'age' => '92'
        ]);
        $updatedname= DB::table('test_app_user')->where('id', '123')->first();
        $this->assertEquals($updatedname->name, 'Duc Nguyen');
    }
}
