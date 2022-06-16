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
              'foto'			=> '84421-2022-06-16-14-42-57.jpg',
              'level'			=> 'admin',
              'remember_token'	=> '94925-2022-03-25-16-11-54.JPG',
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 2,
              'name'  			=> 'User 2',
              'username'		=> 'user2',
              'email' 			=> 'user2@gmail.com',
              'email_verified_at' 			=> NULL,
              'password'		=> bcrypt('user122'),
              'foto'			=>  '59587-2022-06-16-14-44-05.jpg',
              'level'			=> 'bendahara',
              'remember_token'	=> NULL,
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 3,
              'name'  			=> 'User 1',
              'username'		=> 'user1',
              'email' 			=> 'user1@gmail.com',
              'email_verified_at' 			=> NULL,
              'password'		=> bcrypt('user111'),
              'foto'			=> '46468-2022-06-16-14-43-08.jpg',
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
