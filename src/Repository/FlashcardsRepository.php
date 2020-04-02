<?php

namespace App\Repository;

use App\Entity\Flashcards;
use App\Entity\Trash;
use App\Entity\Words;
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

    public function findAllByDefault(int $id)
    {
        //TODO: find out why it works properly
        return $this->createQueryBuilder('f')
            ->select('f.id, w.word AS word, tr.word AS translation, 
                    f.example_sentence, f.pronunciation, f.creation_date')
            ->from(Words::class, 'w')
            ->join(Words::class, 'tr')
            ->leftJoin('f.trash t WITH t.flashcard = f.id', false)
            ->andWhere('f.words = w')
            ->andWhere('f.translations = tr')
            ->andWhere('t IS NULL')
            ->orderBy($this->getSortOption($id)[0], $this->getSortOption($id)[1])
            ->getQuery()
            ->getResult();
    }

    public function findAllByCategory(string $category, int $id)
    {
        return $this->createQueryBuilder('f')
            ->select('f.id, w.word AS word, tr.word AS translation, 
                    f.example_sentence, f.pronunciation, f.creation_date')
            ->from(Words::class, 'w')
            ->join(Words::class, 'tr')
            ->join('f.categories', 'c')
            ->leftJoin('f.trash t WITH t.flashcard = f.id', false)
            ->andWhere('f.words = w')
            ->andWhere('f.translations = tr')
            ->andWhere('c.category_uri = :category')
            ->andWhere('t IS NULL')
            ->setParameter('category', $category)
            ->orderBy($this->getSortOption($id)[0], $this->getSortOption($id)[1])
            ->getQuery()
            ->getResult();
    }

    public function addOneToTrash(int $id)
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

    public function getSortOption(int $id)
    {
        switch ($id) {
            case 1:
            default:
                return ['f.creation_date', 'DESC'];
                break;
            case 2:
                return ['f.creation_date', 'ASC'];
                break;
            case 3:
                return ['w.word', 'ASC'];
                break;
            case 4:
                return ['w.word', 'DESC'];
                break;
        }
    }
}
