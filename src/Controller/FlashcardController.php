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
            ], [
                'id' => 2,
                'word' => 'dog',
                'translation' => 'pies',
                'pronun' => '',
                'example' => 'My dog is brown and very nice.'
            ], [
                'id' => 3,
                'word' => 'specific',
                'translation' => 'konkretny',
                'pronun' => 'spe\'syfik',
                'example' => 'I mean this specific case.'
            ], [
                'id' => 4,
                'word' => 'particular',
                'translation' => 'szczególny',
                'pronun' => 'pe\'tikjula',
                'example' => ''
            ], [
                'id' => 5,
                'word' => 'variable',
                'translation' => 'zmienna',
                'pronun' => '',
                'example' => ''
            ]
        ];
    }

    /**
     * @Route("/")
     * @return Response
     */
    public function showFlashcards(): Response
    {
        return $this->render('main.html.twig', [
            'flashcards' => $this->flashcard,
            'id' => null
        ]);
    }

    /**
     * @Route("/show/{id}")
     * @param int $id
     * @return Response
     */
    public function showFlashcardTranslation(int $id): Response
    {
        return $this->render('main.html.twig', [
            'flashcards' => $this->flashcard,
            'id' => $id
        ]);
    }
}