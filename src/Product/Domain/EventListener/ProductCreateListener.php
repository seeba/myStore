<?php

namespace App\User\Domain\EventListener;

use App\Product\Domain\Event\ProductCreateEvent;
use Psr\Log\LoggerInterface;

class ProductCreateListener 
{
    public function __construct(
        private LoggerInterface $logger
        )
    {}
    
    public function __invoke(ProductCreateEvent $event): void
    {
        
        $this->logger->info('Właśnie utworzyłeś produkt', [
            'name' => $event->getName()
        ]);
    
    }
}