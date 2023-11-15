<?php

declare(strict_types=1);

namespace App\Product\Application\Handler;

use App\Product\Domain\Entity\Product;
use App\Product\Domain\Repository\ProductRepositoryInterface;
use App\Products\Application\Command\CreateProductCommand;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsMessageHandler]
class CreateProductCommandHandler
{
    public function __construct(
        private ProductRepositoryInterface $productRepository, 
        private EventDispatcherInterface $eventDispather,
        private ValidatorInterface $validator
        )
    {}
    
    public function __invoke(CreateProductCommand $command)
    {
        $product = Product::createProduct($command->getName());
        
        $errors = $this->validator->validate($product);

        if (count($errors) > 0 ) {
            $errorString = (string) $errors; 
        }
       
        $this->productRepository->save($product);

        foreach ($product->pullDomainEvents() as $domainEvent) {
            $this->eventDispather->dispatch($domainEvent, $domainEvent::NAME);      
        }   
    }
}