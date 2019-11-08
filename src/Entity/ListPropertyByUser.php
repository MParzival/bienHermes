<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ListPropertyByUserRepository")
 */
class ListPropertyByUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BienHermes", inversedBy="properties")
     */
    private $bien;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="properties")
     */
    private $user;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
