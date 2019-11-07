<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LanguagesRepository")
 */
class Languages
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
    private $language;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Words", mappedBy="languages")
     */
    private $words;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Users", mappedBy="languages")
     */
    private $users;

    public function __construct()
    {
        $this->words = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

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
            $word->setLanguages($this);
        }

        return $this;
    }

    public function removeWord(Words $word): self
    {
        if ($this->words->contains($word)) {
            $this->words->removeElement($word);
            // set the owning side to null (unless already changed)
            if ($word->getLanguages() === $this) {
                $word->setLanguages(null);
            }
        }

        return $this;
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
            $user->setLanguages($this);
        }

        return $this;
    }

    public function removeUser(Users $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getLanguages() === $this) {
                $user->setLanguages(null);
            }
        }

        return $this;
    }
}
