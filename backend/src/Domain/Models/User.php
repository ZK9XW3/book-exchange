<?php

declare(strict_types=1);

namespace App\Domain\Models;

use Ramsey\Uuid\UuidInterface;

final readonly class User
{
    public function __construct(
        private UuidInterface $uuid,
        private string $email,
        private string $password,
        private string $username,
        private string $firstName,
        private string $lastName,
        private int $streetNumber,
        private string $streetAddress,
        private string $city,
        private int $zipCode,
        private string $country,
    )
    {
    }

    public static function create(UuidInterface $uuid, string $email, string $password, string $username, string $firstname, string $lastname, int $streetNumber, string $streetAddress, string $city, int $zipCode, string $country): User
    {
        return new User(
            uuid: $uuid,
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

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getFirstname(): string
    {
        return $this->firstName;
    }

    public function getLastname(): string
    {
        return $this->lastName;
    }

    public function getStreetNumber(): int
    {
        return $this->streetNumber;
    }

    public function getStreetAddress(): string
    {
        return $this->streetAddress;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getZipCode(): int
    {
        return $this->zipCode;
    }

    public function getCountry(): string
    {
        return $this->country;
    }
}
