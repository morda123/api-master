<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Recipe;
use App\Models\Step;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recipes')->insert([
            [
                'title' => 'Spaghetti Carbonara',
                'url' => 'spaghetti_carbonara',
                'category_id' => DB::table('categories')
                    ->where(column: 'name', operator: '=', value: 'Dania z makaronu')->first()?->id,
                'preparation_time' => '00:20:00',
                'difficulty' => 'łatwe'

            ]
        ]);
    }
}
