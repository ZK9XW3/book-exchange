<?php

declare(strict_types=1);

namespace App\Domain\Ports\Repository;

use App\Domain\Models\Book;

interface BookRepositoryInterface
{
    public function save(Book $book): void;
}