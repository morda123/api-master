<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(CategoriesSeeder::class);
//        $this->call(RecipesSeeder::class);
//        $this->call(StepsSeeder::class);
        $this->call(IngredientsSeeder::class);
        $this->call(UnitsSeeder::class);
        //$this->call(IngredientsForRecipesSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
