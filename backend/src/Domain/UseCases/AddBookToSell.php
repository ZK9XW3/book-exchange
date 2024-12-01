<?php

declare(strict_types=1);

namespace App\Domain\UseCases;

use App\Domain\Models\Book;
use App\Domain\Ports\DTO\AddBookToSellRequest;
use App\Domain\Ports\Repository\BookRepositoryInterface;
use Ramsey\Uuid\UuidInterface;

final readonly class AddBookToSell
{
    public function __construct(private BookRepositoryInterface $bookRepository)
    {
    }

    public function __invoke(AddBookToSellRequest $request, UuidInterface $uuid): Book
    {
        $book = Book::create(
            uuid: $uuid,
            title: $request->title,
            author: $request->author,
            isbn: $request->isbn,
            condition: $request->condition,
            price: $request->price
        );

        $this->bookRepository->save($book);

        return $book;
    }
}