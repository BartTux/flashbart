<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WordsRepository")
 */
class Words
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $word;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PartsOfSpeech", inversedBy="words")
     * @ORM\JoinColumn(nullable=false)
     */
    private $parts_of_speech;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Languages", inversedBy="words")
     * @ORM\JoinColumn(nullable=false)
     */
    private $languages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flashcards", mappedBy="words")
     */
    private $flashcards;

    public function __construct()
    {
        $this->flashcards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWord(): ?string
    {
        return $this->word;
    }

    public function setWord(string $word): self
    {
        $this->word = $word;

        return $this;
    }

    public function getPartsOfSpeech(): ?PartsOfSpeech
    {
        return $this->parts_of_speech;
    }

    public function setPartsOfSpeech(?PartsOfSpeech $parts_of_speech): self
    {
        $this->parts_of_speech = $parts_of_speech;

        return $this;
    }

    public function getLanguages(): ?Languages
    {
        return $this->languages;
    }

    public function setLanguages(?Languages $languages): self
    {
        $this->languages = $languages;

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
            $flashcard->setWords($this);
        }

        return $this;
    }

    public function removeFlashcard(Flashcards $flashcard): self
    {
        if ($this->flashcards->contains($flashcard)) {
            $this->flashcards->removeElement($flashcard);
            // set the owning side to null (unless already changed)
            if ($flashcard->getWords() === $this) {
                $flashcard->setWords(null);
            }
        }

        return $this;
    }
}
