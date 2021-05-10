<?php

namespace App\Entity;

use App\Repository\CandidateRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CandidateRepository::class)
 */
class Candidate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */


    private $id;


    /**
     * @ORM\ManyToOne(targetEntity=Position::class, inversedBy="candidates")
     */
    private $position;

    /**
     * @ORM\Column(type="string", length=255, options={"default": "submitted"})
     */
    private $state = 'submitted';

    /**
     * @ORM\ManyToOne(targetEntity=Developer::class, inversedBy="candidates")
     * @ORM\JoinColumn(nullable=false)
     */
    private $developer;


    public function __toString(): string 
    {   
        return $this->developer;
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPosition(): ?Position
    {
        return $this->position;
    }

    public function setPosition(?Position $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getCurrentPlace()
    {
        return $this->currentPlace;
    }

    public function setCurrentPlace($currentPlace, $context = [])
    {
        $this->currentPlace = $currentPlace;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getDeveloper(): ?Developer
    {
        return $this->developer;
    }

    public function setDeveloper(?Developer $developer): self
    {
        $this->developer = $developer;

        return $this;
    }
}
