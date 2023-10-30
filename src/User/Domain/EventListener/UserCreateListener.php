<?php

namespace App\User\Domain\EventListener;

use App\User\Domain\Event\UserCreateEvent;
use Psr\Log\LoggerInterface;

class UserCreateListener 
{
    public function __construct(
        private LoggerInterface $logger
        )
    {}
    
    public function __invoke(UserCreateEvent $event): void
    {
        
        $this->logger->info('Właśnie utworzyłeś uzytkownika', [
            'email' => $event->getEmail()
        ]);
        $this->logger->error('Właśnie  nie utworzyłeś uzytkownika', [
            'email' => $event->getEmail()
        ]);
    }
}