<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->insert([
                [
                    'unit_name' => 'kg',
                    'base_unit' => 'kg',
                    'part_of_base_unit' => 1
                ],
                [
                    'unit_name' => 'g',
                    'base_unit' => 'kg',
                    'part_of_base_unit' => 0.001
                ],
                [
                    'unit_name' => 'dag',
                    'base_unit' => 'kg',
                    'part_of_base_unit' => 0.01
                ],
                [
                    'unit_name' => 'l',
                    'base_unit' => 'l',
                    'part_of_base_unit' => 1
                ],
                [
                    'unit_name' => 'ml',
                    'base_unit' => 'l',
                    'part_of_base_unit' => 0.001
                ],
                [
                    'unit_name' => 'cl',
                    'base_unit' => 'l',
                    'part_of_base_unit' => 0.01
                ],
                [
                    'unit_name' => 'cm^3',
                    'base_unit' => 'l',
                    'part_of_base_unit' => 0.001
                ],
                [
                    'unit_name' => 'dm^3',
                    'base_unit' => 'l',
                    'part_of_base_unit' => 1
                ],
                [
                    'unit_name' => 'szklanka',
                    'base_unit' => 'l',
                    'part_of_base_unit' => 0.25
                ],
                [
                    'unit_name' => 'łyżka stołowa',
                    'base_unit' => 'l',
                    'part_of_base_unit' => 0.015
                ],
                [
                    'unit_name' => 'łyżeczka',
                    'base_unit' => 'l',
                    'part_of_base_unit' => 0.005
                ],
            ]
        );
    }
}
