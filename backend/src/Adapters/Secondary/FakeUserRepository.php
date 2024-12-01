<?php

declare(strict_types=1);

namespace App\Adapters\Secondary;

use App\Domain\Models\User;
use App\Domain\Ports\Repository\UserRepositoryInterface;
use Ramsey\Uuid\UuidInterface;

final class FakeUserRepository implements UserRepositoryInterface
{
    private array $users = [];

    public function save(User $user): void
    {
        $this->users[] = $user;
    }

    public function getUsers(): array
    {
        return $this->users;
    }

    public function getUserByEmail(string $email): ?User
    {
        foreach ($this->users as $user) {
            if ($user->getEmail() === $email) {
                return $user;
            }
        }

        return null;
    }

    public function getUserByUuid(UuidInterface $uuid): ?User
    {
        $results = array_filter($this->users, static fn (User $user) => $user->getUuid() === $uuid);
        if (count($results) === 0) {
            throw new \RuntimeException('Book not found');
        }

        if (count($results) > 1) {
            throw new \RuntimeException('Multiple books found');
        }

        return $results[0];
    }
}