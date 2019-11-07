<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Flashcards;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FlashcardController extends AbstractController
{
    /**
     * @Route("/{slug}", name="flashcard_index", methods={"GET"})
     * @param string $slug
     * @return Response
     */
    public function showFlashcards(string $slug = 'all-cards')
    {
        return $this->render('main.html.twig', $this->getFlashcards($slug));
    }

    /**
     * @Route("/{slug}/show/{id}", name="flashcard_show", methods={"GET"})
     * @param string $slug
     * @param int $id
     * @return Response
     */
    public function showFlashcardTranslation(string $slug, int $id = 0)
    {
        return $this->render('main.html.twig', $this->getFlashcards($slug, $id));
    }

    /**
     * @param string $slug
     * @param $id
     * @return array
     */
    private function getFlashcards(string $slug, $id = null): array
    {
        if ($slug == 'all-cards') {
            $flashcards = $this->getDoctrine()->getRepository(Flashcards::class)
                ->findAll();
        } else {
            $flashcards = $this->getDoctrine()->getRepository(Flashcards::class)
                ->findAllByCategory($slug);
        }

        $categories = $this->getDoctrine()->getRepository(Categories::class)
            ->findAll();

        return [
            'flashcards' => $flashcards,
            'categories' => $categories,
            'slug' => $slug,
            'id' => $id
        ];
    }
}