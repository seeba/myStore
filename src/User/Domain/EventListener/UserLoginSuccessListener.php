<?php

namespace Aoo\User\Domain\EventListener;

use Symfony\Component\Security\Http\Event\LoginSuccessEvent;

class UserLoginSuccessListener 
{
    public function __invoke(LoginSuccessEvent $event)
    {
        
    }
}