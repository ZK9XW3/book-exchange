<?php

declare(strict_types=1);

namespace App\Domain\UseCases;

use App\Domain\Models\User;
use App\Domain\Ports\DTO\CreateUserRequest;
use App\Domain\Ports\Repository\UserRepositoryInterface;
use Ramsey\Uuid\UuidInterface;

final readonly class CreateUser
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function __invoke(CreateUserRequest $request, UuidInterface $uuid): User
    {
        $this->checkForExistingUser($request->email);

        $user = User::create(
            uuid: $uuid,
            email: $request->email,
            password: $request->password,
            username: $request->username,
            firstname: $request->firstname,
            lastname: $request->lastname,
            streetNumber: $request->streetNumber,
            streetAddress: $request->streetAddress,
            city: $request->city,
            zipCode: $request->zipCode,
            country: $request->country
        );

        $this->userRepository->save($user);

        return $user;
    }

    private function checkForExistingUser(string $email): void
    {
        if ($this->userRepository->getUserByEmail($email)) {
            throw new \RuntimeException('User already exists with this email');
        }
    }

}