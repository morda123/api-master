<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientsForRecipesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $recipeID = DB::table('recipes')
            ->where(column: 'title', operator: '=', value: 'Spaghetti Carbonara ')->first()?->id;
        DB::table('ingredients_for_recipes')->insert([
            ['recipe_id' => $recipeID, 'ingredient_id' => 1, 'unit' => 'g', 'amount' => 200],
            ['recipe_id' => $recipeID, 'ingredient_id' => 2, 'unit' => 'g', 'amount' => 100],
            ['recipe_id' => $recipeID, 'ingredient_id' => 3, 'unit' => 'sztuk', 'amount' => 2],
            ['recipe_id' => $recipeID, 'ingredient_id' => 4, 'unit' => 'g', 'amount' => 100],
            ['recipe_id' => $recipeID, 'ingredient_id' => 5, 'unit' => 'g', 'amount' => 30],
            ['recipe_id' => $recipeID, 'ingredient_id' => 6, 'unit' => 'g', 'amount' => 2],
            ['recipe_id' => $recipeID, 'ingredient_id' => 7, 'unit' => 'g', 'amount' => 2],
            ['recipe_id' => $recipeID, 'ingredient_id' => 8, 'unit' => 'sztuk', 'amount' => 1],

        ]);
    }
}
