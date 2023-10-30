<?php

declare(strict_types=1);

namespace App\User\Application\Handler;

use App\User\Application\Command\CreateUserCommand;
use App\User\Domain\Entity\User;
use App\User\Domain\Repository\UserRepositoryInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[AsMessageHandler]
class CreateUserCommandHandler
{
    public function __construct(
        private UserRepositoryInterface $userRepository, 
        private EventDispatcherInterface $eventDispather,
        private UserPasswordHasherInterface $passwordHasher,
        private ValidatorInterface $validator
        )
    {}
    
    public function __invoke(CreateUserCommand $command)
    {
        $user = User::createUser(
            $command->getEmail(), 
            [], $command->getPassword()
        );
        $user->setPassword($this->passwordHasher->hashPassword($user, $command->getPassword()));


        $errors = $this->validator->validate($user);

        if (count($errors) > 0 ) {
            $errorString = (string) $errors; 
        }
       
        $this->userRepository->save($user);

        foreach ($user->pullDomainEvents() as $domainEvent) {
            dump($domainEvent);
            $this->eventDispather->dispatch($domainEvent, $domainEvent::NAME);      
        }   
    }
}