<?php

namespace App\Entity;

use App\Repository\TeammateRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeammateRepository::class)
 */
class Teammate
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
    private $developer_1;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeveloper1(): ?string
    {
        return $this->developer_1;
    }

    public function setDeveloper1(string $developer_1): self
    {
        $this->developer_1 = $developer_1;

        return $this;
    }
}
