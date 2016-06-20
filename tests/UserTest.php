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
        $response = $this->call('GET', '/');

    	$this->assertEquals(200, $response->status());
    }
     public function testGedata()
    {
        $response = $this->call('GET', 'getdata');
    	$this->assertEquals(200, $response->status());
    }
    public function testDetele()
    {
        $response = $this->call('GET', 'detele/10');

    	$this->assertEquals(200, $response->status());
    }
    public function testDatauser()
    {
        $response = $this->call('GET', 'getdatauser/11');

    	$this->assertEquals(200, $response->status());
    }
    public function testUpdate()
    {
        $response = $this->call('POST', 'update/11',['name' => 'Taylor','address' =>'HA NOI','age'=>9]);
    	$this->assertResponseOk();
    }
    public function testCreate()
    {
        $response = $this->call('POST', 'create',['name' => 'Taylor','address' =>'HA NOI','age'=>6]);

    	$this->assertResponseOk();
    }
    
}
