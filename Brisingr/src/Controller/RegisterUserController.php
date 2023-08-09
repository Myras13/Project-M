<?php

namespace App\Controller;

use App\DTO\RegisterUserDto;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegisterUserController extends AbstractController
{
    #[Route('/api/register', name: 'register_user', methods: ['POST'])]
    public function register(#[MapRequestPayload] RegisterUserDto $registerUser): JsonResponse 
    {
        dd($registerUser);

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/RegisterUserController.php',
        ]);

    }
}
