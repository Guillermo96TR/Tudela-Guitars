<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UsuarioRepository::class)
 */
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
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
    private $email;

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
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="text")
     */
    private $perfil;

    /**
     * @ORM\OneToMany(targetEntity=Contacto::class, mappedBy="usuario")
     */
    private $Formularios;

    /**
     * @ORM\OneToMany(targetEntity=Guitars::class, mappedBy="usuarios")
     */
    private $guitars;

    /**
     * @ORM\OneToMany(targetEntity=BassGuitar::class, mappedBy="usuario")
     */
    private $bassGuitars;

    public function __construct()
    {
        $this->guitars = new ArrayCollection();
        $this->bassGuitars = new ArrayCollection();
    }


    public function __toString()
    {
        return $this->nombre;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
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

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getPerfil(): ?string
    {
        return $this->perfil;
    }

    public function setPerfil(string $perfil): self
    {
        $this->perfil = $perfil;

        return $this;
    }

    /**
     * @return Collection<int, Contacto>
     */
    public function getFormularios(): Collection
    {
        return $this->Formularios;
    }

    public function addFormulario(Contacto $formulario): self
    {
        if (!$this->Formularios->contains($formulario)) {
            $this->Formularios[] = $formulario;
            $formulario->setUsuario($this);
        }

        return $this;
    }

    public function removeFormulario(Contacto $formulario): self
    {
        if ($this->Formularios->removeElement($formulario)) {
            // set the owning side to null (unless already changed)
            if ($formulario->getUsuario() === $this) {
                $formulario->setUsuario(null);
            }
        }

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
            $guitar->setUsuarios($this);
        }

        return $this;
    }

    public function removeGuitar(Guitars $guitar): self
    {
        if ($this->guitars->removeElement($guitar)) {
            // set the owning side to null (unless already changed)
            if ($guitar->getUsuarios() === $this) {
                $guitar->setUsuarios(null);
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
            $bassGuitar->setUsuario($this);
        }

        return $this;
    }

    public function removeBassGuitar(BassGuitar $bassGuitar): self
    {
        if ($this->bassGuitars->removeElement($bassGuitar)) {
            // set the owning side to null (unless already changed)
            if ($bassGuitar->getUsuario() === $this) {
                $bassGuitar->setUsuario(null);
            }
        }

        return $this;
    }
}
