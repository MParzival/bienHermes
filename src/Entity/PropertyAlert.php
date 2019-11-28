<?php

namespace App\Entity;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\BienHermes", inversedBy="propertyAlerts")
     */
    private $bien;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AlertUser", inversedBy="propertyAlerts")
     */
    private $alertUser;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isSent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBien(): ?BienHermes
    {
        return $this->bien;
    }

    public function setBien(?BienHermes $bien): self
    {
        $this->bien = $bien;

        return $this;
    }

    public function getAlertUser(): ?AlertUser
    {
        return $this->alertUser;
    }

    public function setAlertUser(?AlertUser $alertUser): self
    {
        $this->alertUser = $alertUser;

        return $this;
    }

    public function getIsSent(): ?bool
    {
        return $this->isSent;
    }

    public function setIsSent(bool $isSent): self
    {
        $this->isSent = $isSent;

        return $this;
    }
}
