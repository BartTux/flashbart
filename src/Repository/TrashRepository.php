<?php

namespace App\Repository;

use App\Entity\Flashcards;
use App\Entity\Trash;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Trash|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trash|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trash[]    findAll()
 * @method Trash[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrashRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trash::class);
    }

    //TODO: find out why it works
    public function findAllByTrash()
    {
        return $this->createQueryBuilder('t')
            ->select('f')
            ->from(Flashcards::class, 'f')
            ->leftJoin('f.trash ft WITH ft.flashcard = f.id', false)
            ->andWhere('ft IS NOT NULL')
            ->getQuery()
            ->getResult();
    }
}
