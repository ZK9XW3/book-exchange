<?php

namespace App\Adapters\Secondary\Doctrine;

use App\Adapters\Secondary\Doctrine\Entity\User as UserDoctrineEntity;
use App\Domain\Models\User;
use App\Domain\Ports\Repository\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\UuidInterface;

/**
 * @extends ServiceEntityRepository<UserDoctrineEntity>
 */
class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserDoctrineEntity::class);
    }

    public function save(User $user): void
    {
        $userDoctrineEntity = UserDoctrineEntity::fromDomain($user);

        $this->getEntityManager()->persist($userDoctrineEntity);
        $this->getEntityManager()->flush();
    }

    public function getUsers(): array
    {
        $usersDoctrine = $this->findAll();
        $users = [];
        foreach ($usersDoctrine as $userDoctrine) {
            $users[] = $userDoctrine->toDomain();
        }

        return $users;
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->findOneBy(['email' => $email])?->toDomain();
    }

    public function getUserByUuid(UuidInterface $uuid): ?User
    {
        return $this->findOneBy(['uuid' => $uuid])?->toDomain();
    }
}
