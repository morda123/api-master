<?php
declare(strict_types=1);

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Step;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $categories = Category::all();
        Category::makeRelationWith(Recipe::class);
        Recipe::makeRelationWith(Step::class);
        Recipe::makeRelationWith(Ingredient::class);
        foreach ($categories as $category){
            $category->recipes = $category->recipes();
            foreach ($category->recipes as $recipe){
                $recipe->steps = $recipe->steps();
                $recipe->ingredients = $recipe->ingredients();
            }
        }
        return $this->jsonResponse($categories);
    }
}
