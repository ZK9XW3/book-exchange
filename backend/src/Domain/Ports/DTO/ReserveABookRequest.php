<?php

declare(strict_types=1);

namespace App\Domain\Ports\DTO;

final readonly class ReserveABookRequest
{
    public function __construct(
        public int $bookId,
        public int $buyerId,
        public string $buyerMessage,
    )
    {
    }

}