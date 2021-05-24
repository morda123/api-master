<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ConverterController extends Controller
{
    public function index(Request $request)
    {
        $unitFrom = Unit::query()->where(column: 'unit_name',operator: '=',value: $request->post('unit_from'))->first();
        if (is_null($unitFrom)){
            return $this->jsonResponse([
                'error' => 'jednostka '.$request->post('unit_from').' nie istnieje'
            ],Response::HTTP_NOT_FOUND);
        }
        $unitTo = Unit::query()->where(column: 'unit_name',operator: '=',value: $request->post('unit_to'))->first();
        if (is_null($unitTo)){
            return $this->jsonResponse([
                'error' => 'jednostka '.$request->post('unit_to').' nie istnieje'
            ],Response::HTTP_NOT_FOUND);
        }
        $ingredient = Ingredient::query()->where(column: 'name',operator: '=',value: $request->post('ingredient'))->first();
        if (is_null($ingredient)){
            return $this->jsonResponse([
                'error' => 'składnik '.$request->post('ingredient').' nie istnieje'
            ],Response::HTTP_NOT_FOUND);
        }
        $oneL = $ingredient->base_weight;
        $oneKg = 1 / $oneL;
        $value = 0;
        if ($unitFrom->base_unit === $unitTo->base_unit){
            $value = $unitFrom->part_of_base_unit / $unitTo->part_of_base_unit * $request->post('value');
        }
        if ($unitFrom->base_unit === "l" && $unitTo->base_unit == "kg"){
            $value = $unitFrom->part_of_base_unit / $unitTo->part_of_base_unit * $oneL * $request->post('value');
        }
        if ($unitFrom->base_unit === "kg" && $unitTo->base_unit == "l"){
            $value = $unitFrom->part_of_base_unit / $unitTo->part_of_base_unit * $oneKg * $request->post('value');
        }
        return number_format($value, 2);
    }
}
