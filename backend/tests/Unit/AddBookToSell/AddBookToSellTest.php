<?php

namespace App\Tests\Unit\AddBookToSell;

use App\Adapters\Secondary\FakeBookRepository;
use App\Domain\Enum\Book\Condition;
use App\Domain\Models\Book;
use App\Domain\Ports\DTO\AddBookToSellRequest;
use App\Domain\UseCases\AddBookToSell;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Rfc4122\UuidV4;
use Ramsey\Uuid\UuidInterface;

class AddBookToSellTest extends TestCase
{
    private AddBookToSellRequest $request;

    private FakeBookRepository $bookRepository;

    private UuidInterface $fakeUuid;

    public function setUp(): void
    {
        $this->request = new AddBookToSellRequest(
            title: 'Le seigneur des anneaux',
            author: 'J.R.R. Tolkien',
            condition: Condition::NEW,
            price: 10,
            isbn: '978-2-266-11156-0'
        );

        $this->fakeUuid = UuidV4::fromString('d1b3b3b3-3b3b-3b3b-3b3b-3b3b3b3b3b3b');

        $this->bookRepository = new FakeBookRepository();
    }

    public function testCreateABook(): void
    {
        $addBookToSell = new AddBookToSell($this->bookRepository);
        $expectedBook = Book::create(
            uuid: $this->fakeUuid,
            title: 'Le seigneur des anneaux',
            author: 'J.R.R. Tolkien',
            isbn: '978-2-266-11156-0',
            condition: Condition::NEW,
            price: 10
        );

        $response = $addBookToSell($this->request, $this->fakeUuid);

        $this->assertEquals($expectedBook, $response);
    }

    public function testCreateABookSavesABook(): void
    {
        $addBookToSell = new AddBookToSell($this->bookRepository);
        $expectedBook = Book::create(
            uuid: $this->fakeUuid,
            title: 'Le seigneur des anneaux',
            author: 'J.R.R. Tolkien',
            isbn: '978-2-266-11156-0',
            condition: Condition::NEW,
            price: 10
        );

        ($addBookToSell)($this->request, $this->fakeUuid);

        $this->assertEquals($expectedBook, $this->bookRepository->getBookByUuid($this->fakeUuid));
    }
}
