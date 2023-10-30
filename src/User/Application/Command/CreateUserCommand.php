<?php

namespace App\User\Application\Command;

class CreateUserCommand 
{
    private string $password;
    private string $email;

    public function __construct($email, $password)
    {
            $this->password = $password;
            $this->email = $email;    
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}