<?php

declare(strict_types=1);

namespace App\Domain\Ports\DTO;

use Symfony\Component\Validator\Constraints as Assert;


final readonly class AddBookToSellRequest
{
    public function __construct(
        #[Assert\NotBlank]
        public string $title,

        #[Assert\NotBlank]
        public string $author,

        #[Assert\Isbn]
        public string $isbn,

        #[Assert\NotBlank]
        public string $condition,

        #[Assert\NotBlank]
        #[Assert\PositiveOrZero]
        public int $price,
    ) {
    }
}