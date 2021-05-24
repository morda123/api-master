<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\IngredientsForRecipe;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class RecipeGenerationController extends Controller
{
    public function index(Request $request)
    {
        $ingredientsInput = $request->post('ingredients');

        $recipeQuery = IngredientsForRecipe::query()
            ->join('recipes','recipe_id','=','recipes.id')
            ->select(DB::raw('recipe_id, count(*) as number_of_ingredients'))
            ->groupBy('recipe_id')
            ->orderBy('number_of_ingredients', 'desc');
        $useAll = $request->post('use_all');
        if ($ingredientsInput) {
            $ingredients = explode(",", $ingredientsInput);
            foreach ($ingredients as &$ingredient) {
                $ingredient = trim($ingredient);
            }
            $ingredientsDb = Ingredient::query()->whereIn('name', $ingredients)
                ->get()->pluck(value: 'name', key: 'id');
            $recipeQuery->whereIn('ingredient_id', array_keys($ingredientsDb->toArray()));
            if ($useAll) {
                $recipeQuery->having('number_of_ingredients','=',count($ingredients));
            }
        }

        $difficulty = $request->post('difficulty');
        if ($difficulty) {
            $recipeQuery->where('difficulty', $difficulty);
        }
        $cost = $request->post('cost');
        if ($cost) {
            $recipeQuery->where('cost', $cost);
        }
        $duration = $request->post('duration');
        if ($duration) {
            $recipeQuery->whereBetween(DB::raw('TIME_TO_SEC(preparation_time) / 60'), explode(',', $duration));
        }

        $recipeId = $recipeQuery->get()->pluck(value: 'number_of_ingredients', key: 'recipe_id')->toArray();

        //return $this->jsonResponse($recipeId);
        $recipes = Recipe::query()->whereIn('id', array_keys($recipeId))->get();
        $result = [];
        foreach ($recipeId as $key => $number) {
            $result[$key] = $recipes->filter(fn(Recipe $item) => $item->id === $key)->first();
            $result[$key]->category_name = Category::query()
                ->where('id', $result[$key]->category_id)->first()?->name;
            $result[$key]->category_url = Category::query()
                ->where('id', $result[$key]->category_id)->first()?->url;
            $result[$key]->full_url = URL::to('przepisy/' . $result[$key]->category . '/' . $result[$key]->url);
            $result[$key]->number_of_ingredients = $number;
        }
        foreach ($recipeId as $key => $recipe){
            $result[$key]->category = Category::query()
                ->where('id', $result[$key]->category_id)->first()?->url;
            $result[$key]->full_url = URL::to('przepisy/' . $result[$key]->category . '/' . $result[$key]->url);
        }

        return $this->jsonResponse(array_values($result));
    }
}
