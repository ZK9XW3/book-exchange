<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Domain\Enum\Book\Condition;

final readonly class Book
{
    public function __construct(
        private string $title,
        private string $author,
        private string $isbn,
        private Condition $condition,
        private int $price,
    ) {}

    public static function create(string $title, string $author, string $isbn, Condition $condition, int $price): Book
    {
        return new Book($title, $author, $isbn, $condition, $price);
    }

    public function getTitle(): string
    {
        return ucfirst($this->title);
    }

    public function getAuthor(): string
    {
        return ucfirst($this->author);
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function getConditionString(): string
    {
        return $this->condition->value;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getCondition(): Condition
    {
        return $this->condition;
    }
}