<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoriesRepository")
 */
class Categories
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flashcards", mappedBy="categories")
     */
    private $flashcards;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $category_uri;

    public function __construct()
    {
        $this->flashcards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $flashcard->setCategories($this);
        }

        return $this;
    }

    public function removeFlashcard(Flashcards $flashcard): self
    {
        if ($this->flashcards->contains($flashcard)) {
            $this->flashcards->removeElement($flashcard);
            // set the owning side to null (unless already changed)
            if ($flashcard->getCategories() === $this) {
                $flashcard->setCategories(null);
            }
        }

        return $this;
    }

    public function getCategoryUri(): ?string
    {
        return $this->category_uri;
    }

    public function setCategoryUri(string $category_uri): self
    {
        $this->category_uri = $category_uri;

        return $this;
    }
}
