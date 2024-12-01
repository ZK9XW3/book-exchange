<?php

declare(strict_types=1);

namespace App\Adapters\Primary\Symfony\Controller;

use App\Domain\Ports\DTO\AddBookToSellRequest;
use App\Domain\Ports\DTO\CreateUserRequest;
use App\Domain\UseCases\AddBookToSell;
use App\Domain\UseCases\CreateUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Ramsey\Uuid\Uuid;

final readonly class CreateUserController
{
    public function __construct(private CreateUser $createUser)
    {
    }

    #[Route('/create-user', name: self::class, methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] CreateUserRequest $request): JsonResponse
    {
        $user = ($this->createUser)($request, Uuid::uuid4());

        $response = [
            'message' => 'User created successfully',
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
        ];

        return new JsonResponse($response);
    }
}