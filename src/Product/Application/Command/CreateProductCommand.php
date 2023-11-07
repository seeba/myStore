<?php

namespace App\Products\Application\Command;

class CreateProductCommand 
{
    public function __construct(
        private string $name
        )
    {}
    
    public function getName(): string
    {
        return $this->name;
    }
    
}