<?php

namespace App\EntityListener;

use App\Entity\Candidate;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class candidateEntityListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Candidate $candidate, LifecycleEventArgs $event)
    {
        $candidate->computeSlug($this->slugger);
    }

    public function preUpdate(Candidate $candidate, LifecycleEventArgs $event)
    {
        $candidate->computeSlug($this->slugger);
    }
}
