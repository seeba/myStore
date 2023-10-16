<?php

namespace App\User\Domain\EventListener;

use App\User\Domain\Event\UserCreateEvent;

class UserCreateListener 
{
    public function __invoke(UserCreateEvent $event): void
    {
        dd($event->getUserId());
    }
}