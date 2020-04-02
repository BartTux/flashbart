<?php

namespace App\Controller;

use App\Entity\Flashcards;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FlashcardTwoController extends AbstractController
{
    /**
     * @Route("/{slug}/get/{id}", name="flashcard_get_data", methods={"POST"})
     * @param string $slug
     * @param int $id
     * @return Response
     */
    public function getFlashcards(int $id, string $slug = 'all-cards')
    {
        if ($slug === 'all-cards') {
            $flashcards = $this->getDoctrine()->getRepository(Flashcards::class)
                ->findAllByDefault($id);
        } else {
            $flashcards = $this->getDoctrine()->getRepository(Flashcards::class)
                ->findAllByCategory($slug, $id);
        }

        return $this->render('loop.html.twig', [
            'flashcards' => $flashcards,
            'slug' => $slug
        ]);
    }
}