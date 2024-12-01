<?php

declare(strict_types=1);

namespace App\Domain\Ports\Repository;

use App\Domain\Models\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;

    public function getUsers(): array;

    public function getUserByEmail(string $email): ?User;
}