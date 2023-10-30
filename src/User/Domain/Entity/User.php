<?php

namespace App\User\Domain\Entity;

use App\Shared\Aggregate\AggregateRoot;
use App\User\Domain\Event\UserCreateEvent;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqueEntity('email')]
class User extends AggregateRoot implements UserInterface, PasswordAuthenticatedUserInterface
{
    private UserPasswordHasherInterface $passwordHasher;

    private ?string $id = null;

    
    private ?string $email = null;

    private array $roles = [];

    /**
     * @var string The hashed password
     */
    private ?string $password = null;

    public function __construct(string $id)
    {
        $this->id = $id;
        
    }
    
    public function getId(): ?string
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public static function createUser($email, array $roles, string $password): self
    {
        $userId = Uuid::uuid4()->toString();
        $user = new User($userId);
        $user->setEmail($email);
        $user->setRoles($roles);
        $user->setPassword($password);

        $user->recordDomainEvent(new UserCreateEvent($userId, $email));

        return $user;
    }
}
