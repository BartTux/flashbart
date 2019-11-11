<?php

namespace App\Controller;

use App\Entity\Trash;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrashController extends AbstractController
{
    /**
     * @Route("/trash", name="trash_deleted_flashcards", methods={"GET"})
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
}
