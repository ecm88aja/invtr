<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
        		'name'=>'admin',
        		'email'=>'dadisuhar@gmail.com',
        		'password'=>bcrypt('123456789'),
        		'role'=>1
        	]);
    }
}
