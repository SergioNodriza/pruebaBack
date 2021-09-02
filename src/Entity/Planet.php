<?php

namespace App\Entity;

use App\Repository\PlanetRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanetRepository::class)
 */
class Planet
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rotation_period;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $orbital_period;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $diameter;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $films_count;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $created;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $edited;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
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

    public function getRotationPeriod(): ?int
    {
        return $this->rotation_period;
    }

    public function setRotationPeriod(?int $rotation_period): self
    {
        $this->rotation_period = $rotation_period;

        return $this;
    }

    public function getOrbitalPeriod(): ?int
    {
        return $this->orbital_period;
    }

    public function setOrbitalPeriod(?int $orbital_period): self
    {
        $this->orbital_period = $orbital_period;

        return $this;
    }

    public function getDiameter(): ?int
    {
        return $this->diameter;
    }

    public function setDiameter(?int $diameter): self
    {
        $this->diameter = $diameter;

        return $this;
    }

    public function getFilmsCount(): ?int
    {
        return $this->films_count;
    }

    public function setFilmsCount(?int $films_count): self
    {
        $this->films_count = $films_count;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(?\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getEdited(): ?\DateTimeInterface
    {
        return $this->edited;
    }

    public function setEdited(?\DateTimeInterface $edited): self
    {
        $this->edited = $edited;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
