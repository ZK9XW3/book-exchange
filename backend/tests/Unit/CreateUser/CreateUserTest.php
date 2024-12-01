<?php

namespace App\Tests\Unit\CreateUser;

use App\Adapters\Secondary\FakeUserRepository;
use App\Domain\Models\User;
use App\Domain\Ports\DTO\CreateUserRequest;
use App\Domain\UseCases\CreateUser;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Rfc4122\UuidV4;
use Ramsey\Uuid\UuidInterface;

class CreateUserTest extends TestCase
{
    public CreateUserRequest $createUserRequest;

    public FakeUserRepository $userRepository;

    private UuidInterface $fakeUuid;

    public function setUp(): void
    {
        $this->userRepository = new FakeUserRepository();

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

        $this->fakeUuid = UuidV4::fromString('d1b3b3b3-3b3b-3b3b-3b3b-3b3b3b3b3b3b');
    }

    public function testCreateAUser(): void
    {
        $createUser = new CreateUser($this->userRepository);
        $expectedUser = User::create(
            uuid: $this->fakeUuid,
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

        $response = $createUser($this->createUserRequest, $this->fakeUuid);

        $this->assertEquals($expectedUser, $response);
    }

    public function testCreateAUserSavesAUser(): void
    {
        $createUser = new CreateUser($this->userRepository);
        $expectedUser = User::create(
            uuid: $this->fakeUuid,
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

        ($createUser)($this->createUserRequest, $this->fakeUuid);

        $this->assertEquals($expectedUser, $this->userRepository->getUserByUuid($this->fakeUuid));
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
        ($createUser)($firstUserRequest, $this->fakeUuid);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('User already exists with this email');

        ($createUser)($this->createUserRequest, $this->fakeUuid);
    }



}
