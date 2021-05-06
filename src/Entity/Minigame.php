<?php

namespace App\Entity;

use App\Repository\MinigameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MinigameRepository::class)
 */
class Minigame
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tag;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="minigame")
     */
    private $questions;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active = true;

    /**
     * @ORM\OneToMany(targetEntity=FunCityName::class, mappedBy="minigame")
     */
    private $funCityNames;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->funCityNames = new ArrayCollection();
    }

    public function __toString() {
        return $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setMinigame($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getMinigame() === $this) {
                $question->setMinigame(null);
            }
        }

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return Collection|FunCityName[]
     */
    public function getFunCityNames(): Collection
    {
        return $this->funCityNames;
    }

    public function addFunCityName(FunCityName $funCityName): self
    {
        if (!$this->funCityNames->contains($funCityName)) {
            $this->funCityNames[] = $funCityName;
            $funCityName->setMinigame($this);
        }

        return $this;
    }

    public function removeFunCityName(FunCityName $funCityName): self
    {
        if ($this->funCityNames->removeElement($funCityName)) {
            // set the owning side to null (unless already changed)
            if ($funCityName->getMinigame() === $this) {
                $funCityName->setMinigame(null);
            }
        }

        return $this;
    }
}
