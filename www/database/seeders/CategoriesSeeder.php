<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'zupy', 'url' => 'zupy'],
            ['name' => 'śniadania', 'url' => 'sniadania'],
            ['name' => 'obiady', 'url' => 'obiady'],
            ['name' => 'kolacje', 'url' => 'kolacje'],
            ['name' => 'Dania z makaronu', 'url' => 'dania_z_makaronem'],
            ['name' => 'sałatki', 'url' => 'salatki']
        ]);
    }
}
