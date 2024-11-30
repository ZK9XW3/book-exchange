<?php

declare(strict_types=1);

namespace App\Domain\Ports\DTO;

use App\Domain\Enum\Book\Condition;
use Symfony\Component\Validator\Constraints as Assert;


final readonly class AddBookToSellRequest
{
    public function __construct(
        #[Assert\NotBlank]
        public string $title,

        #[Assert\NotBlank]
        public string $author,

        #[Assert\NotBlank]
        public Condition $condition,

        #[Assert\NotBlank]
        #[Assert\PositiveOrZero]
        public int $price,

        #[Assert\Isbn]
        public ?string $isbn = null,
    ) {
    }
}