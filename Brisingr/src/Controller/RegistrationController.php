<?php

namespace App\Controller;

use App\DTO\RegisterUserDto;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\Contracts\UserServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends AbstractController
{
    public function __construct(
        private UserServiceInterface $userServiceInterface
    ) {
    }

    #[Route('/api/register', name: 'register_user', methods: ['POST'])]
    public function registerUser(#[MapRequestPayload] RegisterUserDto $registerUser): JsonResponse 
    {
        $user = $this->userServiceInterface->register($registerUser); 
        
        return $this->json([], Response::HTTP_NO_CONTENT, ['location' => "/api/user/{$user->getId()}"]);
    }
}
