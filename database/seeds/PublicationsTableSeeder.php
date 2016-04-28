<?php

use Illuminate\Database\Seeder;

class PublicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Publications')->insert(
            array(
                array(
                    'name' => 'first Pubications',
                    'description' => 'test',
                    'ID_Author' => 1,
                    'ID_Project' => 1
                )
            )
        );
    }
}
