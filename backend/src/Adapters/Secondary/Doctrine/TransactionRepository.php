<?php

declare(strict_types=1);

namespace App\Adapters\Secondary\Doctrine;

use App\Domain\Models\Transaction;
use App\Domain\Ports\Repository\TransactionRepositoryInterface;

final readonly class TransactionRepository implements TransactionRepositoryInterface
{
    public function save(Transaction $transaction): void
    {
    }
}