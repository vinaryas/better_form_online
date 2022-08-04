<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Mapping_appSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mapping_app_form_head')->insert
        (
            [
                'region_id' => 1,
                'role_id' => 2,
                'position' => 1,
            ],
            [
                'region_id' => 1,
                'role_id' => 3,
                'position' => 2,
            ],
            [
                'region_id' => 1,
                'role_id' => 5,
                'position' => 2,
            ],
            [
                'region_id' => 1,
                'role_id' => 4,
                'position' => 3,
            ],
            [
                'region_id' => 2,
                'role_id' => 2,
                'position' => 1,
            ],
            [
                'region_id' => 2,
                'role_id' => 3,
                'position' => 2,
            ],
            [
                'region_id' => 2,
                'role_id' => 5,
                'position' => 2,
            ],
            [
                'region_id' => 2,
                'role_id' => 4,
                'position' => 3,
            ],
        );
    }
}
