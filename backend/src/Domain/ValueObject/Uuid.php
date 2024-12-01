<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use Symfony\Component\Uid\Uuid as SymfonyUuid;

final readonly class Uuid
{
    public function __construct(private SymfonyUuid $uuid)
    {
    }

    public static function generate(): self
    {
        return new self(SymfonyUuid::v4());
    }

    public static function fromString(string $uuid): self
    {
        return new self(SymfonyUuid::fromString($uuid));
    }

    public function toString(): string
    {
        return $this->uuid->toRfc4122();
    }

    public function equals(Uuid $uuid): bool
    {
        return $this->uuid->equals($uuid->uuid);
    }

}