<?php

namespace App\Models;


use App\Attributes\DatabaseRelation;
use Illuminate\Database\Eloquent\Model as ModelBase;

class Model extends ModelBase
{
    protected static array $customRelations = [];

    public static function makeRelationWith(string $className): void
    {
        static::$customRelations[$className] = $className;
    }

    public function toArray(): array
    {
        $result = parent::toArray();
        $reflection = new \ReflectionClass($this);
        $properties = $reflection->getProperties();
        foreach ($properties as $property) {
            $attributes = $property->getAttributes(DatabaseRelation::class);
            if (empty($attributes)){
                continue;
            }
            $attribute = $attributes[0]->newInstance();
            /* @var DatabaseRelation $attribute */
            if (isset(self::$customRelations[$attribute->className])){
                $result[$property->getName()] = $property->getValue($this);
            }
        }
        return $result;
    }
}
