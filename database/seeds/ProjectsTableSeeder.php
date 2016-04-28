<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Projects')->insert(
            array(
                array(
                    'name' => 'amazing',
                    'description' => 'would be an amazing and beautiful white page',
                    'project_creator' => 1
                )
            )
        );
        DB::table('project_members')->insert(
            array(
                array(
                    'member_id' => 1,
                    'project_id' => 1
                )
            )
        );

        DB::table('Projects')->insert(
            array(
                array(
                    'name' => 'amazing2',
                    'description' => 'would be an amazing and beautiful white page',
                    'project_creator' => 2
                )
            )
        );
        DB::table('project_members')->insert(
            array(
                array(
                    'member_id' => 2,
                    'project_id' => 2
                )
            )
        );
        DB::table('Projects')->insert(
            array(
                array(
                    'name' => 'amazingly old',
                    'description' => 'would be an amazing and beautiful white page',
                    'project_creator' => 1,
                    'past' => true
                )
            )
        );
    }
}
