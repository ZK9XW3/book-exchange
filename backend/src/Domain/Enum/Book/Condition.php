<?php

declare(strict_types=1);

namespace App\Domain\Enum\Book;

enum Condition: string
{
    case NEW = 'new';
    case GOOD = 'good';
    case FAIR = 'fair';
    case POOR = 'poor';
}
