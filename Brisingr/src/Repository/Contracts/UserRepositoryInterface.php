<?php

namespace App\Repository\Contracts;

use App\DTO\RegisterUserDto;
use App\Entity\User;

interface UserRepositoryInterface
{
    public function findOneBy(array $criteria, array $orderBy = null): ?User;
    public function create(RegisterUserDto $dto): User;
}