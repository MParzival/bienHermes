<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PropertyAlertRepository")
 */
class PropertyAlert
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BienHermes", mappedBy="propertyAlert")
     */
    private $bien;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Alert", mappedBy="propertyAlert")
     */
    private $alert;

    /**
     * @ORM\Column(type="datetime")
     */
    private $sendedAt;

    public function __construct()
    {
        $this->bien = new ArrayCollection();
        $this->alert = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|BienHermes[]
     */
    public function getBien(): Collection
    {
        return $this->bien;
    }

    public function addBien(BienHermes $bien): self
    {
        if (!$this->bien->contains($bien)) {
            $this->bien[] = $bien;
            $bien->setPropertyAlert($this);
        }

        return $this;
    }

    public function removeBien(BienHermes $bien): self
    {
        if ($this->bien->contains($bien)) {
            $this->bien->removeElement($bien);
            // set the owning side to null (unless already changed)
            if ($bien->getPropertyAlert() === $this) {
                $bien->setPropertyAlert(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Alert[]
     */
    public function getAlert(): Collection
    {
        return $this->alert;
    }

    public function addAlert(Alert $alert): self
    {
        if (!$this->alert->contains($alert)) {
            $this->alert[] = $alert;
            $alert->setPropertyAlert($this);
        }

        return $this;
    }

    public function removeAlert(Alert $alert): self
    {
        if ($this->alert->contains($alert)) {
            $this->alert->removeElement($alert);
            // set the owning side to null (unless already changed)
            if ($alert->getPropertyAlert() === $this) {
                $alert->setPropertyAlert(null);
            }
        }

        return $this;
    }

    public function getSendedAt(): ?\DateTimeInterface
    {
        return $this->sendedAt;
    }

    public function setSendedAt(\DateTimeInterface $sendedAt): self
    {
        $this->sendedAt = $sendedAt;

        return $this;
    }
}
