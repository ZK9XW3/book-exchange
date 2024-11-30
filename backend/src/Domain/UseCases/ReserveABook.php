<?php

declare(strict_types=1);

namespace App\Domain\UseCases;

use App\Domain\Ports\DTO\ReserveABookRequest;
use App\Domain\Models\Transaction;
use App\Domain\Ports\Repository\TransactionRepositoryInterface;

final readonly class ReserveABook
{
    public function __construct(private TransactionRepositoryInterface $transactionRepository)
    {
    }

    public function __invoke(ReserveABookRequest $request): Transaction
    {
        $transaction = Transaction::createPending(
            bookId: $request->bookId,
            buyerId: $request->buyerId
        );

        $this->transactionRepository->save($transaction);

        return $transaction;
    }
}
