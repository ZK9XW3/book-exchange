<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Domain\ValueObject\Uuid;

final class User
{
    public function __construct(
        private Uuid $uuid,
        private string $email,
        private string $password,
        private string $username,
        private string $firstname,
        private string $lastname,
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
            uuid: Uuid::generate(),
            email: $email,
            password: $password,
            username: $username,
            firstname: $firstname,
            lastname: $lastname,
            streetNumber: $streetNumber,
            streetAddress: $streetAddress,
            city: $city,
            zipCode: $zipCode,
            country: $country
        );
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = Uuid::fromString($uuid);
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}