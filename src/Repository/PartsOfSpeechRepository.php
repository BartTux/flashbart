<?php

namespace App\Repository;

use App\Entity\PartsOfSpeech;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PartsOfSpeech|null find($id, $lockMode = null, $lockVersion = null)
 * @method PartsOfSpeech|null findOneBy(array $criteria, array $orderBy = null)
 * @method PartsOfSpeech[]    findAll()
 * @method PartsOfSpeech[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartsOfSpeechRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PartsOfSpeech::class);
    }

    // /**
    //  * @return PartsOfSpeech[] Returns an array of PartsOfSpeech objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PartsOfSpeech
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
