<?php

namespace App\Product\Domain\Entity;

use App\Shared\Aggregate\AggregateRoot;
use Ramsey\Uuid\Uuid;

class Product extends AggregateRoot 
{
    private ?string $id = null;
    private string $name;
    
    public function __construct(string $id)
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
        $productId = Uuid::uuid4()->toString();
        $product = new Product($productId);
        $product->setName($name);

        // #todo add event

        return $product;
    }
}
