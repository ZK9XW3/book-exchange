<?php

declare(strict_types=1);

namespace App\Domain\Ports\DTO;

final readonly class CreateUserRequest
{
    public function __construct(
        public string $email,
        public string $password,
        public string $username,
        public string $firstName,
        public string $lastName,
        public string $streetNumber,
        public string $streetAddress,
        public string $city,
        public string $zipCode,
        public string $country
    )
    {
    }

}