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
        $pass = '$2y$10$AqRUnZok5AmSRHG4FqMM7uIP4xj077JC4Im4Cw2rRV/vOhZ6g15ku';

        DB::table('users')->insert(
            array(
                array(
                    'name' => 'Eddie',
                    'email' => 'eddie@hotmail.com',
                    'password' => $pass,
                    'past' => true,
                    'user_type' => 1
                )
            )
        );

        DB::table('users')->insert(
            array(
                array(
                    'name' => 'admin',
                    'email' => 'eddietschofen@hotmail.com',
                    'password' => $pass,

                    'user_type' => 1
                ),

                array(
                    'name' => 'Pepito',
                    'email' => 'eddietschofen@gmail.fr',
                    'password' => $pass,

                    'user_type' => 2
                ),

                array(
                    'name' => 'yohan',
                    'email' => 'yohan@hotmail.fr',
                    'password' => $pass,

                    'user_type' => 2
                ),

                array(
                    'name' => 'emeric',
                    'email' => 'eemerix@hotmail.fr',
                    'password' => $pass,

                    'user_type' => 2
                ),
            )
        );

        DB::table('users')->insert(
            array(
                array(
                    'name' => 'Satan',
                    'email' => 'eddie-body@hotmail.fr',
                    'password' => $pass,
                    'supervisor' => 1,

                    'user_type' => 3
                )
            )
        );
    }
}
