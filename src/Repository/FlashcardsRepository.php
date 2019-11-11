<?php

namespace App\Repository;

use App\Entity\Flashcards;
use App\Entity\Trash;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

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

    public function findAllByDefault()
    {
        //TODO: find out why it works properly
        return $this->createQueryBuilder('f')
            ->leftJoin('f.trash t WITH t.flashcard = f.id', false)
            ->andWhere('t IS NULL')
            ->getQuery()
            ->getResult();
    }

    public function findAllByCategory($category)
    {
        return $this->createQueryBuilder('f')
            ->join('f.categories', 'c')
            ->leftJoin('f.trash t WITH t.flashcard = f.id', false)
            ->andWhere('c.category_uri = :category')
            ->andWhere('t IS NULL')
            ->setParameter('category', $category)
            ->getQuery()
            ->getResult();
    }

    public function addOneToTrash($id)
    {
        $flashcard = $this->createQueryBuilder('f')
            ->andWhere('f.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();

        $trash = new Trash();
        $trash->setFlashcard($flashcard);

        $entityManager = $this->_em;
        $entityManager->persist($trash);
        $entityManager->flush();
    }
}
