<?php

namespace App\Product\Domain\Event;

use App\Shared\Event\DomainEventInterface;
use Symfony\Contracts\EventDispatcher\Event;

final class ProductCreateEvent extends Event implements DomainEventInterface 
{
    public const NAME = 'product.created';
    
    public function __construct(
        private string $productId, 
        private string $name)
    {}

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getName(): string
    {
         return $this->name;
    }
}