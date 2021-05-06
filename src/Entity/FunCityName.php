<?php

namespace App\Entity;

use App\Repository\FunCityNameRepository;
use App\Repository\MinigameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\Security;

/**
 * @ORM\Entity(repositoryClass=FunCityNameRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class FunCityName
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
    private $name;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $latitude;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $longitude;

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

    /**
     * @ORM\ManyToMany(targetEntity=Region::class, inversedBy="funCityNames")
     */
    private $regions;

    /**
     * @ORM\ManyToOne(targetEntity=Minigame::class, inversedBy="funCityNames")
     */
    private $minigame;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    public function __construct()
    {
        $this->regions = new ArrayCollection();
    }

    public function __toString() {
        if ($this->name !== null) {
            return $this->name;
        }

        return '(vide)';
    }

    public function prePersist(Security $security, MinigameRepository $minigameRepository): void
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->creator = $security->getUser();
        $this->minigame = $minigameRepository->findOneBy(['tag' => 'coc']);
    }

    public function preUpdate(Security $security, MinigameRepository $minigameRepository): void
    {
        $this->updatedAt = new \DateTimeImmutable();
        $this->lastUpdater = $security->getUser();
        $this->minigame = $minigameRepository->findOneBy(['tag' => 'coc']);
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;

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

    public function getRegionName() {
        $regions = array();
        foreach ($this->regions as $value) {
            $regions[] = $value->getName();
        }
        return implode(",", $regions);
    }

    /**
     * @return Collection|Region[]
     */
    public function getRegions(): Collection
    {
        return $this->regions;
    }

    public function addRegion(Region $region): self
    {
        if (!$this->regions->contains($region)) {
            $this->regions[] = $region;
        }

        return $this;
    }

    public function removeRegion(Region $region): self
    {
        $this->regions->removeElement($region);

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
