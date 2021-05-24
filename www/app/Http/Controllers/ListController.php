<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListController extends Controller
{
    public function index(Request $request, string $categoryName): JsonResponse
    {
        $category = Category::query()
            ->where(column: 'url', operator: '=', value: $categoryName)->limit(1)->first();
        if (is_null($category)) {
            return $this->jsonResponse([
                'error' => 'Kategoria ' . $categoryName . ' nie istnieje'
            ], Response::HTTP_NOT_FOUND);
        }
        return $this->jsonResponse(
            Recipe::query()->where(column: 'category_id', operator: '=', value: $category->id)->get());
    }
}
