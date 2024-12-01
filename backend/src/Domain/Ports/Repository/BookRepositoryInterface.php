<?php

declare(strict_types=1);

namespace App\Domain\Ports\Repository;

use App\Domain\Models\Book;
use Ramsey\Uuid\UuidInterface;

interface BookRepositoryInterface
{
    public function save(Book $book): void;

    public function getBooks(): array;

    public function getBookByUuid(UuidInterface $uuid): Book;
}