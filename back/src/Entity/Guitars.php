<?php

namespace App\Entity;

use App\Repository\GuitarsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GuitarsRepository::class)
 */
class Guitars
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
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $caracteristicas;

    /**
     * @ORM\Column(type="smallint")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=Usuario::class, inversedBy="guitars")
     */
    private $usuarios;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imagen;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCaracteristicas(): ?string
    {
        return $this->caracteristicas;
    }

    public function setCaracteristicas(string $caracteristicas): self
    {
        $this->caracteristicas = $caracteristicas;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getUsuarios(): ?Usuario
    {
        return $this->usuarios;
    }

    public function setUsuarios(?Usuario $usuarios): self
    {
        $this->usuarios = $usuarios;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }
}
