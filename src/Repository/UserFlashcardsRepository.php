<?php

namespace App\Repository;

use App\Entity\UserFlashcards;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserFlashcards|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserFlashcards|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserFlashcards[]    findAll()
 * @method UserFlashcards[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserFlashcardsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserFlashcards::class);
    }

    // /**
    //  * @return UserFlashcards[] Returns an array of UserFlashcards objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserFlashcards
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
