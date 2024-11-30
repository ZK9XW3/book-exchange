<?php

declare(strict_types=1);

namespace App\Adapters\Primary\Symfony\Controller;

use App\Domain\Ports\DTO\ReserveABookRequest;
use App\Domain\UseCases\ReserveABook;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final readonly class ReserveABookController
{
    public function __construct(private ReserveABook $getBook)
    {
    }

    #[Route('/get-book', name: self::class, methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] ReserveABookRequest $request): JsonResponse
    {
        $transaction = ($this->getBook)($request);

        $response = [
            'notificationMessage' => 'Book booked successfully',
            'status' => $transaction->getStatusString(),
            'transactionId' => $transaction->getTransactionId(),
            'bookId' => $transaction->getBookId(),
            'buyerId' => $transaction->getBuyerId(),
        ];

        return new JsonResponse($response);
    }
}