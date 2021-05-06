<?php

namespace App\EntityListener;

use App\Entity\FunCityName;
use App\Repository\MinigameRepository;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;

class FunCityNameListener
{
    private $security;
    private $minigameRepository;

    public function __construct(Security $security, MinigameRepository $minigameRepository)
    {
        $this->security = $security;
        $this->minigameRepository = $minigameRepository;
    }

    public function prePersist(FunCityName $funCityName, LifecycleEventArgs $event)
    {
        $funCityName->prePersist($this->security, $this->minigameRepository);
    }

    public function preUpdate(FunCityName $funCityName, LifecycleEventArgs $event)
    {
        $funCityName->preUpdate($this->security, $this->minigameRepository);
    }
}