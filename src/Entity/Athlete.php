<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AthleteRepository")
 */
class Athlete
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $member;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CrossfitClass", mappedBy="athletes")
     */
    private $classes;

    public function __construct()
    {
        $this->classes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMember(): ?bool
    {
        return $this->member;
    }

    public function setMember(bool $member): self
    {
        $this->member = $member;

        return $this;
    }

    /**
     * @return Collection|CrossfitClass[]
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(CrossfitClass $class): self
    {
        if (!$this->classes->contains($class)) {
            $this->classes[] = $class;
            $class->addAthlete($this);
        }

        return $this;
    }

    public function removeClass(CrossfitClass $class): self
    {
        if ($this->classes->contains($class)) {
            $this->classes->removeElement($class);
            $class->removeAthlete($this);
        }

        return $this;
    }

}
