<?php

namespace App\EntityListener;

use App\Entity\Position;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class PositionEntityListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Position $position, LifecycleEventArgs $event)
    {
        $position->computeSlug($this->slugger);
    }

    public function preUpdate(Position $position, LifecycleEventArgs $event)
    {
        $position->computeSlug($this->slugger);
    }
}
