<?php

use App\Http\Controllers\AllIngredientsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConverterController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RecipeGenerationController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/skladniki',[AllIngredientsController::class, 'forRecipe']);
Route::get('/jednostki',[UnitController::class, 'index']);
Route::get('/przepisy',[CategoryController::class, 'index']);
Route::get('/przepisy/{category}',[ListController::class, 'index']);
Route::get('/przepisy/{category}/{recipe}',[RecipeController::class, 'index']);
Route::post('/przelicznik',[ConverterController::class,'index']);
Route::get('/przelicznik/lista',[AllIngredientsController::class,'index']);
Route::post('przepisy/generator',[RecipeGenerationController::class,'index']);
