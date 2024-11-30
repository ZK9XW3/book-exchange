<?php

declare(strict_types=1);

namespace App\Domain\Enum\Transaction;

enum Status: string
{
    case PENDING = 'PENDING';
    case ACCEPTED = 'ACCEPTED';
    case REFUSED = 'REFUSED';
    case CANCELED = 'CANCELED';
    case SENT = 'SENT';
    case ERROR = 'ERROR';
}
