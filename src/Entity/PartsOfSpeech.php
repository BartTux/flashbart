<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartsOfSpeechRepository")
 */
class PartsOfSpeech
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $part_of_speech;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Words", mappedBy="parts_of_speech")
     */
    private $words;

    public function __construct()
    {
        $this->words = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPartOfSpeech(): ?string
    {
        return $this->part_of_speech;
    }

    public function setPartOfSpeech(string $part_of_speech): self
    {
        $this->part_of_speech = $part_of_speech;

        return $this;
    }

    /**
     * @return Collection|Words[]
     */
    public function getWords(): Collection
    {
        return $this->words;
    }

    public function addWord(Words $word): self
    {
        if (!$this->words->contains($word)) {
            $this->words[] = $word;
            $word->setPartsOfSpeech($this);
        }

        return $this;
    }

    public function removeWord(Words $word): self
    {
        if ($this->words->contains($word)) {
            $this->words->removeElement($word);
            // set the owning side to null (unless already changed)
            if ($word->getPartsOfSpeech() === $this) {
                $word->setPartsOfSpeech(null);
            }
        }

        return $this;
    }
}
