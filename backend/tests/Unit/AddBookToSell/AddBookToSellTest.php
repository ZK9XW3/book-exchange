<?php

namespace App\Tests\Unit\AddBookToSell;

use App\Adapters\Secondary\FakeBookRepository;
use App\Domain\Enum\Book\Condition;
use App\Domain\Models\Book;
use App\Domain\Ports\DTO\AddBookToSellRequest;
use App\Domain\UseCases\AddBookToSell;
use PHPUnit\Framework\TestCase;

class AddBookToSellTest extends TestCase
{
    private AddBookToSellRequest $request;

    private FakeBookRepository $bookRepository;

    public function setUp(): void
    {
        $this->request = new AddBookToSellRequest(
            title: 'Le seigneur des anneaux',
            author: 'J.R.R. Tolkien',
            condition: Condition::NEW,
            price: 10,
            isbn: '978-2-266-11156-0'
        );

        $this->bookRepository = new FakeBookRepository();
    }

    public function testCreatesABook(): void
    {
        $addBookToSell = new AddBookToSell($this->bookRepository);
        $response = $addBookToSell($this->request);

        $expectedBook = Book::create(
            title: 'Le seigneur des anneaux',
            author: 'J.R.R. Tolkien',
            isbn: '978-2-266-11156-0',
            condition: Condition::NEW,
            price: 10
        );

        $this->assertEquals($expectedBook, $response);
    }
}
