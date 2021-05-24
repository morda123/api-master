<?php

namespace App\Models;

use App\Attributes\DatabaseRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;

class Recipe extends Model
{
    use HasFactory;

    #[DatabaseRelation(Step::class)]
    public Collection $steps;

    #[DatabaseRelation(Ingredient::class)]
    public Collection $ingredients;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->steps = new Collection();
        $this->ingredients = new Collection();
    }

    public function steps(): Collection
    {
        return $this->hasMany(Step::class)->get()
            //->map(fn (Step $step) => $step->title);
            ->map(function (Step $step){
               return $step->title;
            });

    }

    public function ingredients(): Collection
    {
        return Ingredient::getForRecipe($this->id);
    }
}
