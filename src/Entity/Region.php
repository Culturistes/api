<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RegionRepository::class)
 */
class Region
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
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Question::class, mappedBy="region")
     */
    private $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestions(Question $questions): self
    {
        if (!$this->questions->contains($questions)) {
            $this->questions[] = $questions;
            $questions->addRegion($this);
        }

        return $this;
    }

    public function removeQuestions(Question $questions): self
    {
        if ($this->questions->removeElement($questions)) {
            $questions->removeRegion($this);
        }

        return $this;
    }

    public function getNbrQuiz() {
        $val = 0;
        foreach ($this->questions as $value) {
            if ($value->getMinigame()->getTag() == 'quiz') {
                $val++;
            }
        }
        return $val;
    }

    public function getNbrLme() {
        $val = 0;
        foreach ($this->questions as $value) {
            if ($value->getMinigame()->getTag() == 'lme') {
                $val++;
            }
        }
        return $val;
    }
}
