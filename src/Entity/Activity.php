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
     * @ORM\OneToMany(targetEntity="AlertUser", mappedBy="idActivity")
     */
    private $alertUSers;

    public function __construct()
    {
        $this->alertUSers = new ArrayCollection();
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
     * @return Collection|AlertUser[]
     */
    public function getAlertUSers(): Collection
    {
        return $this->alertUSers;
    }

    public function addAlertUSer(AlertUser $alertUSer): self
    {
        if (!$this->alertUSers->contains($alertUSer)) {
            $this->alertUSers[] = $alertUSer;
            $alertUSer->setIdActivity($this);
        }

        return $this;
    }

    public function removeAlertUSer(AlertUser $alertUSer): self
    {
        if ($this->alertUSers->contains($alertUSer)) {
            $this->alertUSers->removeElement($alertUSer);
            // set the owning side to null (unless already changed)
            if ($alertUSer->getIdActivity() === $this) {
                $alertUSer->setIdActivity(null);
            }
        }

        return $this;
    }


}
