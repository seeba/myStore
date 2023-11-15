<?php

namespace App\Product\Domain\Event;

use App\Product\Domain\Entity\ProductId;
use App\Product\Infrastructure\Repository\ProductRepository;
use App\Shared\Event\DomainEventInterface;
use Symfony\Contracts\EventDispatcher\Event;

final class ProductCreateEvent extends Event implements DomainEventInterface 
{
    public const NAME = 'product.created';
    
    public function __construct(
        private ProductId $productId, 
        private string $name)
    {}

    public function getProductId(): ProductId
    {
        return $this->productId;
    }

    public function getName(): string
    {
         return $this->name;
    }
}