<?php

namespace App\Controller;

use App\Entity\Flashcards;
use App\Form\Type\FlashcardType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     * @param string $slug
     * @return Response
     */
    public function showFlashcards(Request $request, string $slug = 'all-cards')
    {
        return $this->render('main.html.twig', $this->getFlashcards($request, $slug));
    }

    /**
     * @Route("/show/{id}", name="flashcard_show", methods={"GET", "POST"})
     * @param Request $request
     * @param string $slug
     * @param int $id
     * @return Response
     */
    public function showFlashcardTranslation(Request $request, string $slug, int $id = 0)
    {
        return $this->render('main.html.twig', $this->getFlashcards($request, $slug, $id));
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
     * @param Request $request
     * @param string $slug
     * @param $id
     * @return array
     */
    private function getFlashcards(Request $request, string $slug, $id = null): array
    {
        $exSentence = ', f.example_sentence';
        $pronunciation = ', f.pronunciation';
        $sortBy = 'f.creation_date';
        $sortMethod = 'DESC';

        $form = $this->createForm(FlashcardType::class);

        $form->handleRequest($request);
        if ($form->get('submit')->isClicked()) {

            $data = $form->getData();

            if (!$data['exampleSentence']) {
                $exSentence = '';
            }

            if (!$data['pronunciation']) {
                $pronunciation = '';
            }

            switch ($data['sortBy']) {
                case 1:
                    $sortBy = 'f.creation_date';
                    $sortMethod = 'ASC';
                    break;
                case 2:
                    $sortBy = 'f.creation_date';
                    break;
                case 3:
                    $sortBy = 'w.word';
                    $sortMethod = 'ASC';
                    break;
                case 4:
                    $sortBy = 'w.word';
                    break;
            }
        }

        if ($slug == 'all-cards') {
            $flashcards = $this->getDoctrine()->getRepository(Flashcards::class)
                ->findAllByDefault($exSentence, $pronunciation, $sortBy, $sortMethod);
        } else {
            $flashcards = $this->getDoctrine()->getRepository(Flashcards::class)
                ->findAllByCategory($slug, $exSentence, $pronunciation, $sortBy, $sortMethod);
        }

        return [
            'flashcards' => $flashcards,
            'form' => $form->createView(),
            'slug' => $slug,
            'id' => $id
        ];
    }
}
