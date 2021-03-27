<?php

namespace App\Entity;

use App\Repository\SkillSetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SkillSetRepository::class)
 */
class SkillSet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $skill;

    /**
     * @ORM\Column(type="integer")
     */
    private $percentage;

    /**
     * @ORM\ManyToOne(targetEntity=Developer::class, inversedBy="skillSet")
     * @ORM\JoinColumn(nullable=false)
     */
    private $developer;

    
    public function __toString(): string 
    {
        return $this->skill;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSkill(): ?string
    {
        return $this->skill;
    }

    public function setSkill(string $skill): self
    {
        $this->skill = $skill;

        return $this;
    }

    public function getPercentage(): ?int
    {
        return $this->percentage;
    }

    public function setPercentage(int $percentage): self
    {
        $this->percentage = $percentage;

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
