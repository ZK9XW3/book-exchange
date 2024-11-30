<?php

declare(strict_types=1);

namespace App\Adapters\Secondary;

use App\Domain\Models\Transaction;
use App\Domain\Ports\Repository\TransactionRepositoryInterface;

final class FakeTransactionRepository implements TransactionRepositoryInterface
{
    private array $transactions = [];

    public function save(Transaction $transaction): void
    {
        $this->transactions[] = $transaction;
    }

    public function getTransactions(): array
    {
        return $this->transactions;
    }
}