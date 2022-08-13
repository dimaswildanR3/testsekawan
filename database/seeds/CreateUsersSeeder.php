<?php

use Illuminate\Database\Seeder;
use App\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'Admin',
               'email'=>'admin@sekawan',
                'is_admin'=>'2',
               'password'=> bcrypt('123456'),
            ],
            [
                'name'=>'penyetuju',
                'email'=>'Penyetuju@sekawan.com',
                 'is_admin'=>'1',
                'password'=> bcrypt('123456'),
             ],
           
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}