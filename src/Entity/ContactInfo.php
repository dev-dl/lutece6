<?php

namespace App\Entity;

use App\Repository\ContactInfoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContactInfoRepository::class)
 */
class ContactInfo
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
    private $DeveloperId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $network;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adress;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeveloperId(): ?int
    {
        return $this->DeveloperId;
    }

    public function setDeveloperId(int $DeveloperId): self
    {
        $this->DeveloperId = $DeveloperId;

        return $this;
    }

    public function getNetwork(): ?string
    {
        return $this->network;
    }

    public function setNetwork(string $network): self
    {
        $this->network = $network;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }
}
