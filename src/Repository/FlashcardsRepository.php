<?php

namespace App\Repository;

use App\Entity\Flashcards;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Flashcards|null find($id, $lockMode = null, $lockVersion = null)
 * @method Flashcards|null findOneBy(array $criteria, array $orderBy = null)
 * @method Flashcards[]    findAll()
 * @method Flashcards[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlashcardsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Flashcards::class);
    }

    // /**
    //  * @return Flashcards[] Returns an array of Flashcards objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    public function findAllByCategory($category)
    {
        return $this->createQueryBuilder('f')
            ->join('f.categories', 'c')
            ->andWhere('c.category_uri = :category')
            ->setParameter('category', $category)
            ->getQuery()
            ->getResult();
    }

}
