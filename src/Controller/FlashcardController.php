<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FlashcardController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function showFlashcards()
    {
        $flashcard = [
            [
                'word' => 'ratification',
                'translation' => '',
                'pronun' => 'ra\'tifikejszyn',
                'example' => 'It\'s our priev to got ratification.',
            ], [
                'word' => 'dog',
                'translation' => '',
                'pronun' => '',
                'example' => 'My dog is brown and very nice.'
            ], [
                'word' => 'specific',
                'translation' => '',
                'pronun' => 'spe\'syfik',
                'example' => 'I mean this specific case.'
            ], [
                'word' => 'particular',
                'translation' => '',
                'pronun' => 'pe\'tikjula',
                'example' => ''
            ], [
                'word' => 'variable',
                'translation' => '',
                'pronun' => '',
                'example' => ''
            ]
        ];

        return $this->render('main.html.twig', [
            'flashcards' => $flashcard
        ]);
    }
}