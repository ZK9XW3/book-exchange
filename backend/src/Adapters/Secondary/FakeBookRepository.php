<?php

declare(strict_types=1);

namespace App\Adapters\Secondary;

use App\Domain\Models\Book;
use App\Domain\Ports\Repository\BookRepositoryInterface;

final class FakeBookRepository implements BookRepositoryInterface
{
    private array $books = [];

    public function save(Book $book): void
    {
        $this->books[] = $book;
    }

    public function getBooks(): array
    {
        return $this->books;
    }

    public function getBookById(int $id): Book
    {
        return $this->books[$id];
    }
}