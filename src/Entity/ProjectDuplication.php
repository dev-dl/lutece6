<?php

namespace App\Entity;

use App\Repository\ProjectDuplicationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectDuplicationRepository::class)
 */
class ProjectDuplication
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $duplicatedFrom;

    /**
     * @ORM\Column(type="integer")
     */
    private $duplicatedTo;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuplicatedFrom(): ?int
    {
        return $this->duplicatedFrom;
    }

    public function setDuplicatedFrom(int $duplicatedFrom): self
    {
        $this->duplicatedFrom = $duplicatedFrom;

        return $this;
    }

    public function getDuplicatedTo(): ?int
    {
        return $this->duplicatedTo;
    }

    public function setDuplicatedTo(int $duplicatedTo): self
    {
        $this->duplicatedTo = $duplicatedTo;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
