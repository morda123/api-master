<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        return $this->jsonResponse(
            [
                [
                    'value' => 'kg',
                    'name' => 'kilogramy'
                ],
                [
                    'value' => 'g',
                    'name' => 'gramy'
                ],
                [
                    'value' => 'dag',
                    'name' => 'dekagramy'
                ],
                [
                    'value' => 'l',
                    'name' => 'litry'
                ],
                [
                    'value' => 'ml',
                    'name' => 'mililitry'
                ],
                [
                    'value' => 'cl',
                    'name' => 'centylitry'
                ],
                [
                    'value' => 'cm^3',
                    'name' => 'centymetry sześcienne'
                ],
                [
                    'value' => 'dm^3',
                    'name' => 'decymetry sześcienne'
                ],
                [
                    'value' => 'szklanka',
                    'name' => 'szklanki'
                ],
                [
                    'value' => 'łyżka stołowa',
                    'name' => 'łyżki stołowe'
                ],
                [
                    'value' => 'łyżeczka',
                    'name' => 'łyżeczki'
                ],
            ]
        );
    }
}
