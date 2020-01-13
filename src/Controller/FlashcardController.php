<?php

namespace App\Controller;

use App\Entity\Flashcards;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\Type\FlashcardType;
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
     * @Route(name="flashcard_index", methods={"GET", "POST"})
     * @param string $slug
     * @return Response
     */
    public function showFlashcards(string $slug = 'all-cards')
    {
        return $this->render('main.html.twig', $this->getFlashcards($slug));
    }

    /**
     * @Route("/show/{id}", name="flashcard_show", methods={"GET", "POST"})
     * @param string $slug
     * @param int $id
     * @return Response
     */
    public function showFlashcardTranslation(string $slug, int $id = 0)
    {
        return $this->render('main.html.twig', $this->getFlashcards($slug, $id));
    }

    /**
     * @Route("/delete/{id}", name="flashcard_delete", methods={"GET"})
     * @param string $slug
     * @param int $id
     * @return RedirectResponse
     */
    public function deleteFlashcard(string $slug, int $id)
    {
        $this->getDoctrine()->getRepository(Flashcards::class)
            ->addOneToTrash($id);

        return $this->redirect('http://localhost:8000/' . $slug);
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
                ->findAllByDefault();
        } else {
            $flashcards = $this->getDoctrine()->getRepository(Flashcards::class)
                ->findAllByCategory($slug);
        }

        $form = $this->createForm(FlashcardType::class);

        return [
            'flashcards' => $flashcards,
            'form' => $form->createView(),
            'slug' => $slug,
            'id' => $id
        ];
    }
}
