<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Domain\Enum\Transaction\Status;

final readonly class Transaction
{
    private function __construct(
        private int    $id,
        private int    $bookId,
        private int    $buyerId,
        private Status $status,
    ) {
    }

    public static function createPending(int $bookId, int $buyerId): self
    {
        return new self(
            id: random_int(0, 100),
            bookId: $bookId,
            buyerId: $buyerId,
            status: Status::PENDING,
        );
    }

    public function getStatusString(): string
    {
        return $this->status->value;
    }

    public function getTransactionId(): int
    {
        return $this->id;
    }

    public function getBookId(): int
    {
        return $this->bookId;
    }

    public function getBuyerId(): int
    {
        return $this->buyerId;
    }
}
