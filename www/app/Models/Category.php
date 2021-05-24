<?php

namespace App\Models;

use App\Attributes\DatabaseRelation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use ReflectionException;
use ReflectionProperty;

class Category extends Model
{
    use HasFactory;


    #[DatabaseRelation(Recipe::class)]
    public Collection $recipes;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->recipes = collect([]);
    }

    public function recipes(): Collection
    {
        return $this->hasMany(Recipe::class)->get();
    }
}
