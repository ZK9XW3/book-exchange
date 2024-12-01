<?php

declare(strict_types=1);

namespace App\Adapters\Secondary;

use App\Domain\Models\User;
use App\Domain\Ports\Repository\UserRepositoryInterface;

final class FakeUserRepository implements UserRepositoryInterface
{
    private array $users = [];

    public function save(User $user): void
    {
        $user->setUuid('13df23da-3adb-4144-89b4-dfcf200feca2');
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
}