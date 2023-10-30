<?php

declare(strict_types=1);

namespace App\User\Application\Controller\Api;

use App\User\Application\Command\CreateUserCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('test', name:'app_test')]
class CreateUserController extends AbstractController
{
    use HandleTrait;
    
    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }
    
    public function __invoke(Request $request): JsonResponse
    {
        $command = new CreateUserCommand('6@wp.pl', 'wrz4jk94');
        $this->messageBus->dispatch($command);
        
        return new JsonResponse(['test'], 200);
    }
}