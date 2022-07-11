<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @ORM\OneToMany(targetEntity=Guitars::class, mappedBy="users")
     */
    private $guitars;

    /**
     * @ORM\OneToMany(targetEntity=BassGuitar::class, mappedBy="users")
     */
    private $bassGuitars;

    public function __construct()
    {
        $this->guitars = new ArrayCollection();
        $this->bassGuitars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
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
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return Collection<int, Guitars>
     */
    public function getGuitars(): Collection
    {
        return $this->guitars;
    }

    public function addGuitar(Guitars $guitar): self
    {
        if (!$this->guitars->contains($guitar)) {
            $this->guitars[] = $guitar;
            $guitar->setUsers($this);
        }

        return $this;
    }

    public function removeGuitar(Guitars $guitar): self
    {
        if ($this->guitars->removeElement($guitar)) {
            // set the owning side to null (unless already changed)
            if ($guitar->getUsers() === $this) {
                $guitar->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BassGuitar>
     */
    public function getBassGuitars(): Collection
    {
        return $this->bassGuitars;
    }

    public function addBassGuitar(BassGuitar $bassGuitar): self
    {
        if (!$this->bassGuitars->contains($bassGuitar)) {
            $this->bassGuitars[] = $bassGuitar;
            $bassGuitar->setUsers($this);
        }

        return $this;
    }

    public function removeBassGuitar(BassGuitar $bassGuitar): self
    {
        if ($this->bassGuitars->removeElement($bassGuitar)) {
            // set the owning side to null (unless already changed)
            if ($bassGuitar->getUsers() === $this) {
                $bassGuitar->setUsers(null);
            }
        }

        return $this;
    }
}
