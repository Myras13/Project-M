<?php

namespace App\Services;

use App\DTO\RegisterUserDto;
use App\Entity\User;
use App\Exceptions\HTTP\ConflictException;
use App\Repository\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;

class UserService implements UserServiceInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ){    
    }

    public function register(RegisterUserDto $dto): User
    {
        $user = $this->userRepository->findOneBy([
            'email' => $dto->email
        ]);

        if (!is_null($user)) {
            throw new ConflictException('User already exists.');
        }

        $user = $this->userRepository->create($dto);

        return $user;
    }
}