<?php

declare(strict_types=1);

namespace App\Domain\Ports\DTO;

final readonly class CreateUserRequest
{
    public function __construct(
        public string $email,
        public string $password,
        public string $username,
        public string $firstname,
        public string $lastname,
        public int    $streetNumber,
        public string $streetAddress,
        public string $city,
        public int    $zipCode,
        public string $country
    )
    {
    }

}