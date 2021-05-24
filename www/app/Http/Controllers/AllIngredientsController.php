<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class AllIngredientsController extends Controller
{
    public function index(Request $request)
    {
        return $this->jsonResponse(Ingredient::query()->where(column: 'recountable',operator: '=',value: 1)->get());
    }
    public function forRecipe(Request $request)
    {
        return $this->jsonResponse(Ingredient::query()
            ->orderBy('name')->get());
    }
}
