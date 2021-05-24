<?php


namespace App\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class DatabaseRelation
{
    public function __construct(
        public string $className,
    ){ }
}
