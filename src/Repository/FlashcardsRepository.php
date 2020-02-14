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

    public function findAllByDefault(
        $exSentence,
        $pronunciation,
        $sortOption
    ){
        //TODO: find out why it works properly
        return $this->createQueryBuilder('f')
            ->select($this->selectColumns($exSentence, $pronunciation))
            ->from(Words::class, 'w')
            ->join(Words::class, 'tr')
            ->leftJoin('f.trash t WITH t.flashcard = f.id', false)
            ->andWhere('f.words = w')
            ->andWhere('f.translations = tr')
            ->andWhere('t IS NULL')
            ->orderBy($this->sortBy($sortOption), $this->sortMethod($sortOption))
            ->getQuery()
            ->getResult();
    }

    public function findAllByCategory(
        $category,
        $exSentence,
        $pronunciation,
        $sortOption
    ){
        return $this->createQueryBuilder('f')
            ->select($this->selectColumns($exSentence, $pronunciation))
            ->from(Words::class, 'w')
            ->join(Words::class, 'tr')
            ->join('f.categories', 'c')
            ->leftJoin('f.trash t WITH t.flashcard = f.id', false)
            ->andWhere('f.words = w')
            ->andWhere('f.translations = tr')
            ->andWhere('c.category_uri = :category')
            ->andWhere('t IS NULL')
            ->setParameter('category', $category)
            ->orderBy($this->sortBy($sortOption), $this->sortMethod($sortOption))
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

    private function selectColumns($exSentence, $pronunciation)
    {
        $result = 'f.id, w.word AS word, tr.word AS translation';

        if ($exSentence) {
            $result .= ', f.example_sentence';
        }
        if ($pronunciation) {
            $result .= ', f.pronunciation';
        }

        return $result;
    }

    private function sortBy($sortOption)
    {
        switch ($sortOption) {
            case 1:
            case 2:
            default:
                $result = 'f.creation_date';
                break;
            case 3:
            case 4:
                $result = 'w.word';
                break;
        }

        return $result;
    }

    private function sortMethod($sortOption)
    {
        switch ($sortOption) {
            case 1:
            case 4:
            default:
                $result = 'DESC';
                break;
            case 2:
            case 3:
                $result = 'ASC';
                break;
        }

        return $result;
    }
}
