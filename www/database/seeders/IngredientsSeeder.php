<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class IngredientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredients')->insert([
            ['name' => 'bułka tarta', 'base_weight' => 0.6, 'recountable' => 1],
            ['name' => 'cukier kryształ', 'base_weight' => 1, 'recountable' => 1],
            ['name' => 'cukier puder', 'base_weight' => 0.6, 'recountable' => 1],
            ['name' => 'groch', 'base_weight' => 0.8, 'recountable' => 1],
            ['name' => 'fasola', 'base_weight' => 0.8, 'recountable' => 1],
            ['name' => 'kakao', 'base_weight' => 0.4, 'recountable' => 1],
            ['name' => 'kasza gryczana', 'base_weight' => 1.32, 'recountable' => 1],
            ['name' => 'kasza jęczmienna', 'base_weight' => 0.72, 'recountable' => 1],
            ['name' => 'kasza manna', 'base_weight' => 1, 'recountable' => 1],
            ['name' => 'majonez', 'base_weight' => 0.8, 'recountable' => 1],
            ['name' => 'masło', 'base_weight' => 0.96, 'recountable' => 1],
            ['name' => 'margaryna', 'base_weight' => 0.96, 'recountable' => 1],
            ['name' => 'mąka pszenna', 'base_weight' => 0.6, 'recountable' => 1],
            ['name' => 'mąka ziemniaczana', 'base_weight' => 0.6, 'recountable' => 1],
            ['name' => 'miód', 'base_weight' => 1.4, 'recountable' => 1],
            ['name' => 'mleko', 'base_weight' => 1, 'recountable' => 1],
            ['name' => 'mleko w proszku', 'base_weight' => 0.48, 'recountable' => 1],
            ['name' => 'oliwa', 'base_weight' => 0.8, 'recountable' => 1],
            ['name' => 'płatki owsiane', 'base_weight' => 0.36, 'recountable' => 1],
            ['name' => 'proszek do pieczenia', 'base_weight' => 0.6, 'recountable' => 1],
            ['name' => 'przecier pomidorowy', 'base_weight' => 1, 'recountable' => 1],
            ['name' => 'ryż', 'base_weight' => 1.04, 'recountable' => 1],
            ['name' => 'smalec', 'base_weight' => 0.88, 'recountable' => 1],
            ['name' => 'śmietana', 'base_weight' => 0.92, 'recountable' => 1],
            ['name' => 'woda', 'base_weight' => 1, 'recountable' => 1],
            ['name' => 'żelatyna', 'base_weight' => 0.8, 'recountable' => 1]
        ]);
    }
}
