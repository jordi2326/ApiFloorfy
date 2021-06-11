<?php

namespace App\Entity;

use App\Entity\Inmueble;
use App\Repository\TourRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TourRepository::class)
 */
class Tour
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Activo;

    /**
     * @ORM\ManyToOne(targetEntity=Inmueble::class, inversedBy="tours")
     */
    private $Inmueble;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActivo(): ?bool
    {
        return $this->Activo;
    }

    public function setActivo(bool $Activo): self
    {
        $this->Activo = $Activo;

        return $this;
    }

    public function getInmueble(): ?Inmueble
    {
        return $this->Inmueble;
    }

    public function setInmueble(?Inmueble $Inmueble): self
    {
        $this->Inmueble = $Inmueble;

        return $this;
    }
}
