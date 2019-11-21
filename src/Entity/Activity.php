<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActivityRepository")
 */
class Activity
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
     * @ORM\OneToMany(targetEntity="Alert", mappedBy="activity")
     */
    private $Critere;

    public function __construct()
    {
        $this->Critere = new ArrayCollection();
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

    /**
     * @return Collection|Alert[]
     */
    public function getCritere(): Collection
    {
        return $this->Critere;
    }

    public function addCritere(Alert $critere): self
    {
        if (!$this->Critere->contains($critere)) {
            $this->Critere[] = $critere;
            $critere->setActivity($this);
        }

        return $this;
    }

    public function removeCritere(Alert $critere): self
    {
        if ($this->Critere->contains($critere)) {
            $this->Critere->removeElement($critere);
            // set the owning side to null (unless already changed)
            if ($critere->getActivity() === $this) {
                $critere->setActivity(null);
            }
        }

        return $this;
    }

}
