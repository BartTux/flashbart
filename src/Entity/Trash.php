<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrashRepository")
 */
class Trash
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Flashcards", inversedBy="trash", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $flashcard;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFlashcard(): ?Flashcards
    {
        return $this->flashcard;
    }

    public function setFlashcard(Flashcards $flashcard): self
    {
        $this->flashcard = $flashcard;

        return $this;
    }
}
