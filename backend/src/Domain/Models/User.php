<?php

declare(strict_types=1);

namespace App\Domain\Models;

final class User
{
    public function __construct(
        private int $id,
        private string $email,
        private string $password,
        private string $username,
        private string $firstName,
        private string $lastName,
        private string $streetNumber,
        private string $streetAddress,
        private string $city,
        private string $zipCode,
        private string $country,
    )
    {
    }

    public static function create(string $email, string $password, string $username, string $firstname, string $lastname, string $streetNumber, string $streetAddress, string $city, string $zipCode, string $country): User
    {
        return new User(
            id: random_int(0, 100),
            email: $email,
            password: $password,
            username: $username,
            firstName: $firstname,
            lastName: $lastname,
            streetNumber: $streetNumber,
            streetAddress: $streetAddress,
            city: $city,
            zipCode: $zipCode,
            country: $country
        );
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}