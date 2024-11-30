<?php

declare(strict_types=1);

namespace App\Domain\Ports\Repository;

use App\Domain\Models\Transaction;

interface TransactionRepositoryInterface
{
    public function save(Transaction $transaction): void;
}