<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FlashcardController extends AbstractController
{
    private $flashcard;

    public function __construct()
    {
        $this->flashcard = [
            [
                'id' => 1,
                'word' => 'ratification',
                'translation' => 'ratyfikacja',
                'pronun' => 'ra\'tifikejszyn',
                'example' => 'It\'s our priev to got ratification.',
                'category' => 'other'
            ], [
                'id' => 2,
                'word' => 'dog',
                'translation' => 'pies',
                'pronun' => '',
                'example' => 'My dog is brown and very nice.',
                'category' => 'animals'
            ], [
                'id' => 3,
                'word' => 'specific',
                'translation' => 'konkretny',
                'pronun' => 'spe\'syfik',
                'example' => 'I mean this specific case.',
                'category' => 'other'
            ], [
                'id' => 4,
                'word' => 'particular',
                'translation' => 'szczególny',
                'pronun' => 'pe\'tikjula',
                'example' => '',
                'category' => 'other'
            ], [
                'id' => 5,
                'word' => 'variable',
                'translation' => 'zmienna',
                'pronun' => '',
                'example' => '',
                'category' => 'other'
            ]
        ];
    }

    /**
     * @Route("/{slug}", name="flashcard_index", methods={"GET"})
     * @param string $slug
     * @return Response
     */
    public function showFlashcards(string $slug): Response
    {
        return $this->render('main.html.twig', [
            'flashcards' => $this->flashcard,
            'category' => $slug,
            'id' => null
        ]);
    }

    /**
     * @Route("/{slug}/show/{id}", name="flashcard_show", methods={"GET"})
     * @param string $slug
     * @param int $id
     * @return Response
     */
    public function showFlashcardTranslation(string $slug, int $id): Response
    {
        return $this->render('main.html.twig', [
            'flashcards' => $this->flashcard,
            'category' => $slug,
            'id' => $id
        ]);
    }
}