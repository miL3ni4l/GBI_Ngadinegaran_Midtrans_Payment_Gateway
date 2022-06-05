<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \App\User::insert([
            [
              'id'  			=> 1,
              'name'  			=> 'Administrator',
              'username'		=> 'admin_gereja',
              'email' 			=> 'admin@gmail.com',
              'email_verified_at' 			=> NULL,
              'password'		=> bcrypt('admin_gereja'),
              'foto'			=> '94925-2022-03-25-16-11-54.JPG',
              'level'			=> 'admin',
              'remember_token'	=> '94925-2022-03-25-16-11-54.JPG',
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 2,
              'name'  			=> 'Santika',
              'username'		=> 'santika',
              'email' 			=> 'santika@gmail.com',
              'email_verified_at' 			=> NULL,
              'password'		=> bcrypt('user321'),
              'foto'			=>  '30928-2022-03-25-16-12-04.JPG',
              'level'			=> 'bendahara',
              'remember_token'	=> NULL,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 3,
              'name'  			=> 'Dita',
              'username'		=> 'dita',
              'email' 			=> 'dita@gmail.com',
              'email_verified_at' 			=> NULL,
              'password'		=> bcrypt('user321'),
              'foto'			=> '41360-2022-03-25-16-12-13.JPG',
              'level'			=> 'bendahara',
              'remember_token'	=> NULL,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 4,
              'name'  			=> 'User',
              'username'		=> 'user',
              'email' 			=> 'user@gmail.com',
              'email_verified_at' 			=> NULL,
              'password'		=> bcrypt('user321'),
              'foto'			=> '33924-2022-03-27-12-15-30.JPG',
              'level'			=> 'bendahara',
              'remember_token'	=> NULL,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ]
        ]);
    }
}
