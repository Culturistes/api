<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

use Symfony\Component\Security\Core\Security;

/**
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 */
class Question
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
    private $title;

    /**
     * @ORM\Column(type="text", length=65535, nullable=true)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="question_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $answers = [];

    /**
     * @ORM\ManyToOne(targetEntity=Minigame::class, inversedBy="questions")
     */
    private $minigame;

    /**
     * @ORM\ManyToMany(targetEntity=Region::class, inversedBy="questions_2")
     */
    private $region;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active = true;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="createdQuestions")
     */
    private $creator;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="updatedQuestions")
     */
    private $lastUpdater;

    public function __construct()
    {
        $this->region = new ArrayCollection();
    }

    public function __toString() {
        if ($this->title !== null) {
            return $this->title;
        }

        return '(vide)';
    }

    public function prePersist(Security $security): void
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->creator = $security->getUser();
    }

    public function preUpdate(Security $security): void
    {
        $this->updatedAt = new \DateTimeImmutable();
        $this->lastUpdater = $security->getUser();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage(?string $image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getAnswers(): ?array
    {
        return $this->answers;
    }

    public function setAnswers(?array $answers): self
    {
        $this->answers = $answers;

        return $this;
    }

    public function getMinigame(): ?Minigame
    {
        return $this->minigame;
    }

    public function setMinigame(?Minigame $minigame): self
    {
        $this->minigame = $minigame;

        return $this;
    }

    /**
     * @return Collection|Region[]
     */
    public function getRegion(): Collection
    {
        return $this->region;
    }

    public function addRegion(Region $region): self
    {
        if (!$this->region->contains($region)) {
            $this->region[] = $region;
        }

        return $this;
    }

    public function removeRegion(Region $region): self
    {
        $this->region->removeElement($region);

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

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

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): self
    {
        $this->creator = $creator;

        return $this;
    }

    public function getLastUpdater(): ?User
    {
        return $this->lastUpdater;
    }

    public function setLastUpdater(?User $lastUpdater): self
    {
        $this->lastUpdater = $lastUpdater;

        return $this;
    }
}
