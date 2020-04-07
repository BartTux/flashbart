<?php

namespace App\Controller;

use App\Entity\Flashcards;
use App\Form\Type\FlashcardType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FlashcardController
 *
 * @package App\Controller
 * @Route("/{slug}")
 */
class FlashcardController extends AbstractController
{
    /**
     * @Route(name="flashcard_index")
     * @param string $slug
     * @return Response
     */
    public function indexAction(string $slug = 'all-cards')
    {
        $form = $this->createForm(FlashcardType::class);

        return $this->render('main.html.twig', [
            'form' => $form->createView(),
            'slug' => $slug
        ]);
    }

    /**
     * @Route("/delete/{id}", name="flashcard_delete", methods={"GET"})
     * @param string $slug
     * @param int $id
     * @return RedirectResponse
     */
    public function moveFlashcardToTrash(string $slug, int $id)
    {
        $this->getDoctrine()->getRepository(Flashcards::class)
            ->addOneToTrash($id);

        return $this->redirectToRoute('flashcard_index', [
            'slug' => $slug
        ]);
    }
}
