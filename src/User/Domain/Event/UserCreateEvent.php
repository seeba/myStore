<?php

namespace App\User\Domain\Event;

use App\Shared\Event\DomainEventInterface;
use Symfony\Contracts\EventDispatcher\Event;

final class UserCreateEvent extends Event implements DomainEventInterface 
{
    public const NAME = 'user.created';
    
    public function __construct(
        private string $userId, 
        private string $email)
    {}

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}