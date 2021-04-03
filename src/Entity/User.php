<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @Assert\Length(min = 5)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="creator")
     */
    private $createdQuestions;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="lastUpdater")
     */
    private $updatedQuestions;

    public function __toString()
    {
        return $this->username;
    }

    public function __construct()
    {
        $this->createdQuestions = new ArrayCollection();
        $this->updatedQuestions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Question[]
     */
    public function getCreatedQuestions(): Collection
    {
        return $this->createdQuestions;
    }

    public function addCreatedQuestion(Question $createdQuestion): self
    {
        if (!$this->createdQuestions->contains($createdQuestion)) {
            $this->createdQuestions[] = $createdQuestion;
            $createdQuestion->setCreator($this);
        }

        return $this;
    }

    public function removeCreatedQuestion(Question $createdQuestion): self
    {
        if ($this->createdQuestions->removeElement($createdQuestion)) {
            // set the owning side to null (unless already changed)
            if ($createdQuestion->getCreator() === $this) {
                $createdQuestion->setCreator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getUpdatedQuestions(): Collection
    {
        return $this->updatedQuestions;
    }

    public function addUpdatedQuestion(Question $updatedQuestion): self
    {
        if (!$this->updatedQuestions->contains($updatedQuestion)) {
            $this->updatedQuestions[] = $updatedQuestion;
            $updatedQuestion->setLastUpdater($this);
        }

        return $this;
    }

    public function removeUpdatedQuestion(Question $updatedQuestion): self
    {
        if ($this->updatedQuestions->removeElement($updatedQuestion)) {
            // set the owning side to null (unless already changed)
            if ($updatedQuestion->getLastUpdater() === $this) {
                $updatedQuestion->setLastUpdater(null);
            }
        }

        return $this;
    }
}
