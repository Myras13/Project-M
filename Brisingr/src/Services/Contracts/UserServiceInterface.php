<?php

namespace App\Services\Contracts;

use App\DTO\RegisterUserDto;
use App\Entity\User;

interface UserServiceInterface
{
    public function register(RegisterUserDto $registerUser): User;
}   