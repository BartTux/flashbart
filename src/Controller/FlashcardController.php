<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FlashcardController extends AbstractController
{
    public function showFlashcards()
    {
        return $this->render('main.html.twig');
    }
}