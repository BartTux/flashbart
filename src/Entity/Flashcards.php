<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FlashcardsRepository")
 */
class Flashcards
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Words", inversedBy="flashcards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $words;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $pronunciation;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $example_sentence;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Words", inversedBy="flashcards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $translations;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $creation_date;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $modified_date;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\UserFlashcards", mappedBy="flashcards")
     */
    private $userFlashcards;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categories", inversedBy="flashcards")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Trash", mappedBy="flashcard", cascade={"persist", "remove"})
     */
    private $trash;

    public function __construct()
    {
        $this->userFlashcards = new ArrayCollection();
        $this->creation_date = new \DateTime();
        $this->modified_date = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWords(): ?Words
    {
        return $this->words;
    }

    public function setWords(?Words $words): self
    {
        $this->words = $words;

        return $this;
    }

    public function getPronunciation(): ?string
    {
        return $this->pronunciation;
    }

    public function setPronunciation(?string $pronunciation): self
    {
        $this->pronunciation = $pronunciation;

        return $this;
    }

    public function getExampleSentence(): ?string
    {
        return $this->example_sentence;
    }

    public function setExampleSentence(?string $example_sentence): self
    {
        $this->example_sentence = $example_sentence;

        return $this;
    }

    public function getTranslations(): ?Words
    {
        return $this->translations;
    }

    public function setTranslations(?Words $translations): self
    {
        $this->translations = $translations;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getModifiedDate(): ?\DateTimeInterface
    {
        return $this->modified_date;
    }

    public function setModifiedDate(\DateTimeInterface $modified_date): self
    {
        $this->modified_date = $modified_date;

        return $this;
    }

    /**
     * @return Collection|UserFlashcards[]
     */
    public function getUserFlashcards(): Collection
    {
        return $this->userFlashcards;
    }

    public function addUserFlashcard(UserFlashcards $userFlashcard): self
    {
        if (!$this->userFlashcards->contains($userFlashcard)) {
            $this->userFlashcards[] = $userFlashcard;
            $userFlashcard->addFlashcard($this);
        }

        return $this;
    }

    public function removeUserFlashcard(UserFlashcards $userFlashcard): self
    {
        if ($this->userFlashcards->contains($userFlashcard)) {
            $this->userFlashcards->removeElement($userFlashcard);
            $userFlashcard->removeFlashcard($this);
        }

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function getTrash(): ?Trash
    {
        return $this->trash;
    }

    public function setTrash(Trash $trash): self
    {
        $this->trash = $trash;

        // set the owning side of the relation if necessary
        if ($trash->getFlashcard() !== $this) {
            $trash->setFlashcard($this);
        }

        return $this;
    }
}
