<?php

declare(strict_types=1);

namespace App\Product\Domain\Entity;

use App\Product\Domain\Event\ProductCreateEvent;
use App\Shared\Aggregate\AggregateRoot;
use App\Product\Domain\Entity\ProductId;

class Product extends AggregateRoot 
{
    private ?ProductId $id = null;
    private string $name;
    
    public function __construct(ProductId $id)
    {
        $this->id = $id;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public static function createProduct(string $name): self
    {
        $productId = ProductId::random();
        $product = new Product($productId);
        $product->setName($name);

        $product->recordDomainEvent(new ProductCreateEvent($productId, $name));

        return $product;
    }
}
