<?php

namespace App\EntityListener;

use App\Entity\Question;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;

class QuestionListener
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function prePersist(Question $question, LifecycleEventArgs $event)
    {
        $question->prePersist($this->security);
    }

    public function preUpdate(Question $question, LifecycleEventArgs $event)
    {
        $question->preUpdate($this->security);
    }
}