<?php

namespace App\Entity;

use App\Repository\DeveloperRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\String\Slugger\SluggerInterface;



/**
 * @ORM\Entity(repositoryClass=DeveloperRepository::class)
 * @UniqueEntity("slug")
 */
class Developer 
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
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $socialNetwork;



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photoFileName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=Activity::class, mappedBy="developer", orphanRemoval=true)
     */
    private $activity;
   
    /**
     * @ORM\OneToMany(targetEntity=SkillSet::class, mappedBy="developer", orphanRemoval=true)
     */
    private $skillSet;
    
    public function __construct()
    {
        $this->activity = new ArrayCollection();
        $this->skillSet = new ArrayCollection();
    }

    public function __toString(): string 
    {
        return $this->firstName.' '.$this->lastName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSocialNetwork(): ?string
    {
        return $this->socialNetwork;
    }

    public function setSocialNetwork(?string $socialNetwork): self
    {
        $this->socialNetwork = $socialNetwork;

        return $this;
    }


    public function getPhotoFileName(): ?string
    {
        return $this->photoFileName;
    }

    public function setPhotoFileName(?string $photoFileName): self
    {
        $this->photoFileName = $photoFileName;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function computeSlug(SluggerInterface $slugger)
    {
        if(!$this->slug || '-'===$this->slug){
            $this->slug =(string) $slugger->slug((string) $this)->lower();
        }
    }

    /**
     * @return Collection|Activity[]
     */
    public function getActivity(): Collection
    {
        return $this->activity;
    }

    public function addActivity(Activity $activity): self
    {
        if (!$this->activity->contains($activity)) {
            $this->activity[] = $activity;
            $activity->setDeveloper($this);
        }

        return $this;
    }

    public function removeActivity(Activity $activity): self
    {
        if ($this->activity->removeElement($activity)) {
            // set the owning side to null (unless already changed)
            if ($activity->getDeveloper() === $this) {
                $activity->setDeveloper(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SkillSet[]
     */
    public function getSkillSet(): Collection
    {
        return $this->skillSet;
    }

    public function addSkillSet(SkillSet $skillSet): self
    {
        if (!$this->skillSet->contains($skillSet)) {
            $this->skillSet[] = $skillSet;
            $skillSet->setDeveloper($this);
        }

        return $this;
    }

    public function removeSkillSet(SkillSet $skillSet): self
    {
        if ($this->skillSet->removeElement($skillSet)) {
            // set the owning side to null (unless already changed)
            if ($skillSet->getDeveloper() === $this) {
                $skillSet->setDeveloper(null);
            }
        }

        return $this;
    }
}
