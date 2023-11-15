<?php

namespace App\Shared\Domain;

use Ramsey\Uuid\Uuid;

class Id
{
    private function __construct(
        protected string $id
    ) 
    {}
    
    final public static function random(): self
    {
        return new static(Uuid::uuid4()->toString());
    }

    protected function toString() 
    {
        return $this->id;
    }
}