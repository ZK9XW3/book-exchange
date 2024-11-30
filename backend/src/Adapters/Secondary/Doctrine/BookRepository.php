<?php

namespace App\Adapters\Secondary\Doctrine;

use App\Adapters\Secondary\Doctrine\Entity\Book as BookDoctrineEntity;
use App\Domain\Models\Book;
use App\Domain\Ports\Repository\BookRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BookDoctrineEntity>
 */
class BookRepository extends ServiceEntityRepository implements BookRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookDoctrineEntity::class);
    }

    public function save(Book $book): void
    {
        $bookDoctrineEntity = new BookDoctrineEntity();
        $bookDoctrineEntity
            ->setTitle($book->getTitle())
            ->setAuthor($book->getAuthor())
            ->setIsbn($book->getIsbn())
            ->setConditionType($book->getCondition())
            ->setPrice($book->getPrice());

        $this->_em->persist($bookDoctrineEntity);
        $this->_em->flush();
    }

    public function getBooks(): array
    {
        $booksDoctrine = $this->findAll();
        $books = [];
        foreach ($booksDoctrine as $bookDoctrine) {
            $books[] = new Book(
                $bookDoctrine->getTitle(),
                $bookDoctrine->getAuthor(),
                $bookDoctrine->getIsbn(),
                $bookDoctrine->getConditionType(),
                $bookDoctrine->getPrice()
            );
        }

        return $books;
    }
}
