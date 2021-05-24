<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StepsSeeder extends Seeder
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
        DB::table('steps')->insert([
            ['recipe_id' => $recipeID, 'title' => 'Makaron ugotować w osolonej wodzie, według przepisu na opakowaniu. Odcedzić. Nie przelewać wodą!'],
            ['recipe_id' => $recipeID, 'title' => 'Boczek pokroić w drobną kostkę. Podsmażyć na patelni na niskiej mocy palnika, aż się lekko zarumieni. (Jeśli boczek jest bardzo chudy, dodać łyżkę oleju).'],
            ['recipe_id' => $recipeID, 'title' => 'Śmietankę, jajka, ser, szczyptę soli i dość dużą ilość pieprzu przełożyć do miski (najlepiej wysokiej i wąskiej) i zmiksować blenderem.'],
            ['recipe_id' => $recipeID, 'title' => 'Ugotowany makaron dodać do gorącego boczku. Przesmażyć, mieszając przez ok. 1 minutę. Patelnię ściągnąć z palnika, dodać masę jajeczną i wymieszać. Można dodać też posiekaną natkę pietruszki. Mieszać przez chwilę, aż wszystkie składniki dobrze się połączą, a sos lekko zgęstnieje. (Lepiej nie mieszać na palniku, żeby nie zrobiła się jajecznica!).'],
            ['recipe_id' => $recipeID, 'title' => 'Wyłożyć na talerze i posypać resztą startego sera.']
        ]);
    }
}
