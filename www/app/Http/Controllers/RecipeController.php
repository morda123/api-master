<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Step;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RecipeController extends Controller
{
    public function index(Request $request, string $categoryName, string $recipeName): JsonResponse
    {
        $category = Category::query()
            ->where(column: 'url',operator: '=',value: $categoryName)->limit(1)->first();
        if (is_null($category)){
            return $this->jsonResponse([
                'error' => 'Kategoria '.$categoryName.' nie istnieje'
            ],Response::HTTP_NOT_FOUND);
        }
        $recipe = Recipe::query()
            ->where(column: 'category_id',operator: '=',value: $category->id)
            ->where(column: 'url',operator: '=',value: $recipeName)
            ->limit(1)->first();
        if (is_null($recipe)){
            return $this->jsonResponse([
                'error' => 'Przepis '.$recipeName.' nie istnieje'
            ],Response::HTTP_NOT_FOUND);
        }
        Recipe::makeRelationWith(Step::class);
        Recipe::makeRelationWith(Ingredient::class);
        $recipe->steps = $recipe->steps();
        $recipe->ingredients = $recipe->ingredients();
        return $this->jsonResponse($recipe);
    }
}
