<?php

namespace App\Tests\Unit\ReserveABook;

use App\Adapters\Secondary\FakeTransactionRepository;
use App\Domain\Models\Transaction;
use App\Domain\Ports\DTO\ReserveABookRequest;
use App\Domain\UseCases\ReserveABook;
use PHPUnit\Framework\TestCase;

class ReserveABookTest extends TestCase
{
    private ReserveABookRequest $request;

    public function setUp(): void
    {
        $this->request = new ReserveABookRequest(
            bookId: 1,
            buyerId: 1,
            buyerMessage: 'Je veux acheter ce livre'
        );

        $this->transactionReposiory = new FakeTransactionRepository();
    }

    public function testGetBookCreateTransactionWithStatusPending(): void
    {
        $getBook = new ReserveABook($this->transactionReposiory);
        $response = $getBook($this->request);

        $this->assertEquals('PENDING', $response->getStatusString());
    }

    public function testGetBookSaveTransaction(): void
    {
        $getBook = new ReserveABook($this->transactionReposiory);
        $response = $getBook($this->request);

        $transactions = $this->transactionReposiory->getTransactions();

        $this->assertCount(1, $transactions);
        $this->assertEquals($response, end($transactions));
    }

    public function testGetBookSaveTransactionWithStatusPending(): void
    {
        $getBook = new ReserveABook($this->transactionReposiory);
        $getBook($this->request);

        $transactions = $this->transactionReposiory->getTransactions();

        $this->assertEquals('PENDING', end($transactions)->getStatusString());
    }
}
