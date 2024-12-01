<?php

declare(strict_types=1);

namespace App\Adapters\Primary\Symfony\Controller;

use App\Domain\Ports\DTO\AddBookToSellRequest;
use App\Domain\UseCases\AddBookToSell;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Ramsey\Uuid\Uuid;

final readonly class AddBookToSellController
{
    public function __construct(private AddBookToSell $addBookToSell)
    {
    }

    #[Route('/add-book-to-sell', name: self::class, methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] AddBookToSellRequest $request): JsonResponse
    {
        $book = ($this->addBookToSell)($request, Uuid::uuid4());

        $response = [
            'message' => 'Book added successfully',
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'isbn' => $book->getIsbn(),
            'condition' => $book->getConditionString(),
            'price' => $book->getPrice(),
        ];

        return new JsonResponse($response);
    }
}