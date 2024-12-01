<?php

namespace App\Tests\Unit\CreateUser;

use App\Adapters\Secondary\FakeUserRepository;
use App\Domain\Models\User;
use App\Domain\Ports\DTO\CreateUserRequest;
use App\Domain\UseCases\CreateUser;
use PHPUnit\Framework\TestCase;

class CreateUserTest extends TestCase
{
    public CreateUserRequest $createUserRequest;

    public FakeUserRepository $userRepository;

    public string $fakeUuid;

    public function setUp(): void
    {
        $this->userRepository = new FakeUserRepository();

        $this->fakeUuid = '13df23da-3adb-4144-89b4-dfcf200feca2';

        $this->createUserRequest = new CreateUserRequest(
            email: 'user@gmail.com',
            password: 'secret',
            username: 'firstUser',
            firstName: 'John',
            lastName: 'Doe',
            streetNumber: '1',
            streetAddress: 'rue de la paix',
            city: 'Paris',
            zipCode: '75000',
            country: 'France'
        );
    }

    public function testCreateAUser(): void
    {
        $createUser = new CreateUser($this->userRepository);
        $expectedUser = User::create(
            email: 'user@gmail.com',
            password: 'secret',
            username: 'firstUser',
            firstname: 'John',
            lastname: 'Doe',
            streetNumber: '1',
            streetAddress: 'rue de la paix',
            city: 'Paris',
            zipCode: '75000',
            country: 'France'
        );
        $expectedUser->setUuid($this->fakeUuid);

        $response = $createUser->__invoke($this->createUserRequest);
        $response->setUuid($this->fakeUuid);

        $this->assertEquals($expectedUser, $response);
    }

    public function testCreatesAUserSaveAUser(): void
    {
        $createUser = new CreateUser($this->userRepository);
        $expectedUser = User::create(
            email: 'user@gmail.com',
            password: 'secret',
            username: 'firstUser',
            firstname: 'John',
            lastname: 'Doe',
            streetNumber: '1',
            streetAddress: 'rue de la paix',
            city: 'Paris',
            zipCode: '75000',
            country: 'France'
        );
        $expectedUser->setUuid($this->fakeUuid);

        ($createUser)($this->createUserRequest);

        $this->assertEquals($expectedUser, $this->userRepository->getUsers()[0]);
    }
    public function testCreatingUserWithExistingEmailThrowsException(): void
    {
        $firstUserRequest = new CreateUserRequest(
            email: 'user@gmail.com',
            password: 'secret',
            username: 'firstUser',
            firstName: 'Jane',
            lastName: 'Doe',
            streetNumber: '2',
            streetAddress: 'rue de la paix',
            city: 'Paris',
            zipCode: '75001',
            country: 'France'
        );
        $createUser = new CreateUser($this->userRepository);
        ($createUser)($firstUserRequest);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('User already exists with this email');

        ($createUser)($this->createUserRequest);
    }
}
