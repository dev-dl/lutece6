<?php

namespace App\EntityListener;

use App\Entity\Developer;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class DeveloperEntityListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Developer $developer, LifecycleEventArgs $event)
    {
        $developer->computeSlug($this->slugger);
    }

    public function preUpdate(Developer $developer, LifecycleEventArgs $event)
    {
        $developer->computeSlug($this->slugger);
    }
}
