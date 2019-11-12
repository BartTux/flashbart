<?php

namespace App\Controller;

use App\Entity\Trash;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrashController extends AbstractController
{
    /**
     * @Route("/trash", name="trash_show_flashcards", methods={"GET"})
     * @return Response
     */
    public function showDeletedFlashcards()
    {
        $deleted = $this->getDoctrine()->getRepository(Trash::class)
            ->findAllByTrash();

        return $this->render('trash/trash.html.twig', [
            'deletedFlashcards' => $deleted,
            'slug' => 'trash'
        ]);
    }

    /**
     * @Route("/trash/restore/{id}", name="trash_restore_flashcard", methods={"GET"})
     * @param int $id
     * @return RedirectResponse
     */
    public function restoreDeletedFlashcard(int $id)
    {
        $this->getDoctrine()->getRepository(Trash::class)
            ->deleteOneFromTrashById($id);

        return $this->redirect('http://localhost:8000/trash');
    }

    /**
     * @Route("/trash/remove/{id}", name="trash_remove_flashcard", methods={"GET"})
     * @param int $id
     * @return RedirectResponse
     */
    public function removeDeletedFlashcard(int $id)
    {
        $this->getDoctrine()->getRepository(Trash::class)
            ->deleteOneById($id);

        return $this->redirect('http://localhost:8000/trash');
    }
}
