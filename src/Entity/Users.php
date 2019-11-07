<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $surename;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Countries", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $countries;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Languages", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $languages;

    /**
     * @ORM\Column(type="array")
     */
    private $gender = [];

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\UserFlashcards", mappedBy="users")
     */
    private $userFlashcards;

    public function __construct()
    {
        $this->userFlashcards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getSurename(): ?string
    {
        return $this->surename;
    }

    public function setSurename(?string $surename): self
    {
        $this->surename = $surename;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCountries(): ?Countries
    {
        return $this->countries;
    }

    public function setCountries(?Countries $countries): self
    {
        $this->countries = $countries;

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

    public function getGender(): ?array
    {
        return $this->gender;
    }

    public function setGender(array $gender): self
    {
        $this->gender = $gender;

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
            $userFlashcard->addUser($this);
        }

        return $this;
    }

    public function removeUserFlashcard(UserFlashcards $userFlashcard): self
    {
        if ($this->userFlashcards->contains($userFlashcard)) {
            $this->userFlashcards->removeElement($userFlashcard);
            $userFlashcard->removeUser($this);
        }

        return $this;
    }
}
