<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class RegisterUserDto
{
    public function __construct(
        #[Assert\NotBlank(message: 'This value should not be blank')]
        #[Assert\Email(message: 'This value is not a valid email address')]
        #[Assert\Length(max: 255)]
        public readonly string $email,

        #[Assert\NotBlank(message: 'This value should not be blank')]
        #[Assert\Length(min: 3, max: 60)]
        public readonly string $username,

        #[Assert\NotBlank(message: 'This value should not be blank')]
        #[Assert\PasswordStrengthValidator(['minScore' => PasswordStrength::STRENGTH_VERY_STRONG])]
        public readonly string $password,
    ) {
    }
}