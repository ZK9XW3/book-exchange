<?php

namespace App\Tests\Unit\AddBookToSell;

use App\Adapters\Secondary\FakeBookRepository;
use App\Domain\Models\Book;
use App\Domain\Ports\DTO\AddBookToSellRequest;
use App\Domain\UseCases\AddBookToSell;
use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    public function setUp(): void
    {
        $this->request = new AddBookToSellRequest(
            title: 'Le seigneur des anneaux',
            author: 'J.R.R. Tolkien',
            isbn: '978-2-266-11156-0',
            condition: 'Comme neuf',
            price: 10
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
            condition: 'Comme neuf',
            price: 10
        );

        $this->assertEquals($expectedBook, $response);
    }
}
