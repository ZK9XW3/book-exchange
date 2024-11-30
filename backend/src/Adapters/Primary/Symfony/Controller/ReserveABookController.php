<?php

declare(strict_types=1);

namespace App\Adapters\Primary\Symfony\Controller;

use App\Domain\Models\Transaction;
use App\Domain\Ports\DTO\ReserveABookRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final readonly class ReserveABookController
{
    public function __construct(private ReserveABookController $getBook)
    {
    }

    #[Route('/get-book', name: self::class, methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] ReserveABookRequest $request): JsonResponse
    {
        /** @var Transaction $result */
        $result = ($this->getBook)($request);

        $response = [
            'notificationMessage' => 'Book booked successfully',
            'status' => $result->getStatusString(),
            'transactionId' => $result->getTransactionId(),
            'bookId' => $result->getBookId(),
            'buyerId' => $result->getBuyerId(),
        ];

        return new JsonResponse($response);
    }
}