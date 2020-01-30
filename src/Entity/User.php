<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"username"}, message="Il existe déjà un compte avec ce pseudo")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = array();

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="WishList", mappedBy="user", orphanRemoval=true)
     */
    private $properties;


    /**
     * @var string
     * le token qui servira lors de l'oubli de mot de passe
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $resetToken;

    /**
     * @ORM\OneToMany(targetEntity="AlertUser", mappedBy="idUser")
     */
    private $alertUsers;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isNego = false;


    public function __construct()
    {
        $this->properties = new ArrayCollection();
        $this->alertUsers = new ArrayCollection();
        $this->roles = array('ROLE_SUPER_ADMIN');
    }
    /**
     * User constructor.
     */
//    public function __construct($email, $username, string $password)
//    {
//        $this->email = $email;
//        $this->username = $username;
//        $this->password = $password;
//    }


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     * @return User
     */
    public function setRoles(array $roles): User
    {
        $this->roles = $roles;
        return $this;
    }


    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return Collection|WishList[]
     */
    public function getProperties(): Collection
    {
        return $this->properties;
    }

    public function addProperty(WishList $property): self
    {
        if (!$this->properties->contains($property)) {
            $this->properties[] = $property;
            $property->setUser($this);
        }

        return $this;
    }

    public function removeProperty(WishList $property): self
    {
        if ($this->properties->contains($property)) {
            $this->properties->removeElement($property);
            // set the owning side to null (unless already changed)
            if ($property->getUser() === $this) {
                $property->setUser(null);
            }
        }

        return $this;
    }



    /**
     * @return string
     */
    public function getResetToken(): string
    {
        return $this->resetToken;
    }

    /**
     * @param string $resetToken
     * @return User
     */
    public function setResetToken(string $resetToken): User
    {
        $this->resetToken = $resetToken;
        return $this;
    }

    /**
     * @return Collection|AlertUser[]
     */
    public function getAlertUsers(): Collection
    {
        return $this->alertUsers;
    }

    public function addAlertUser(AlertUser $alertUser): self
    {
        if (!$this->alertUsers->contains($alertUser)) {
            $this->alertUsers[] = $alertUser;
            $alertUser->setIdUser($this);
        }

        return $this;
    }

    public function removeAlertUser(AlertUser $alertUser): self
    {
        if ($this->alertUsers->contains($alertUser)) {
            $this->alertUsers->removeElement($alertUser);
            // set the owning side to null (unless already changed)
            if ($alertUser->getIdUser() === $this) {
                $alertUser->setIdUser(null);
            }
        }

        return $this;
    }

    public function getIsNego(): ?bool
    {
        return $this->isNego;
    }

    public function setIsNego(bool $isNego): self
    {
        $this->isNego = $isNego;

        return $this;
    }

}
