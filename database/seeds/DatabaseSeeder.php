<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('avatar')->insert([
			['id'=>'1']
		]);
       DB::table('test_app_user')->insert([
			['name'=>'DUC NGUYEN','address'=>'Ha noi','age'=>21,'photo'=>'default.jpg']
		]);    
   }
}
