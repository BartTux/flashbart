<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserFlashcardsRepository")
 */
class UserFlashcards
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Users", inversedBy="userFlashcards")
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Flashcards", inversedBy="userFlashcards")
     */
    private $flashcards;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->flashcards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Users[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Users $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(Users $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
        }

        return $this;
    }

    /**
     * @return Collection|Flashcards[]
     */
    public function getFlashcards(): Collection
    {
        return $this->flashcards;
    }

    public function addFlashcard(Flashcards $flashcard): self
    {
        if (!$this->flashcards->contains($flashcard)) {
            $this->flashcards[] = $flashcard;
        }

        return $this;
    }

    public function removeFlashcard(Flashcards $flashcard): self
    {
        if ($this->flashcards->contains($flashcard)) {
            $this->flashcards->removeElement($flashcard);
        }

        return $this;
    }
}
