<?php

declare(strict_types=1);

namespace App\Adapters\Secondary;

use App\Domain\Models\Book;
use App\Domain\Ports\Repository\BookRepositoryInterface;
use Ramsey\Uuid\UuidInterface;

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

    public function getBookByUuid(UuidInterface $uuid): Book
    {
        $results = array_filter($this->books, static fn (Book $book) => $book->getUuid() === $uuid);
        if (count($results) === 0) {
            throw new \RuntimeException('Book not found');
        }

        if (count($results) > 1) {
            throw new \RuntimeException('Multiple books found');
        }

        return $results[0];
    }
}