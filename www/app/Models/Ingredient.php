<?php

namespace App\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    public static function getForRecipe(int $recipeId): Collection
    {
        return Ingredient::query()
            ->join('ingredients_for_recipes','ingredients.id','=','ingredient_id')
            ->where(column: 'recipe_id',operator: '=',value: $recipeId)
            ->get();
    }
}
