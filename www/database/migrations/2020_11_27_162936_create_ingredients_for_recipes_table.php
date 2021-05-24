<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientsForRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients_for_recipes', function (Blueprint $table) {
            $table->id();
            $table->double('amount');
            $table->string('unit');
            $table->foreignId('recipe_id')->constrained();
            $table->foreignId('ingredient_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredients_for_recipes');
    }
}
