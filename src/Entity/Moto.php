<?php

namespace App\Entity;

use App\Repository\MotoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotoRepository::class)]
class Moto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private string $name;

    #[ORM\Column(length: 100)]
    private string $brand;

    #[ORM\Column]
    private int $year;

    #[ORM\Column]
    private int $power; // en chevaux (HP)

    #[ORM\Column]
    private int $displacement; // cylindrée en cc

    #[ORM\Column(length: 50)]
    private string $engineType; // V4, V-Twin, etc.

    #[ORM\Column(length: 50)]
    private string $category; // Sportive, Roadster, Trail, etc.

    #[ORM\Column(length: 255)]
    private string $image; // nom du fichier image

    /* ======================
       Getters / Setters
    ====================== */

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;
        return $this;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;
        return $this;
    }

    public function getPower(): int
    {
        return $this->power;
    }

    public function setPower(int $power): self
    {
        $this->power = $power;
        return $this;
    }

    public function getDisplacement(): int
    {
        return $this->displacement;
    }

    public function setDisplacement(int $displacement): self
    {
        $this->displacement = $displacement;
        return $this;
    }

    public function getEngineType(): string
    {
        return $this->engineType;
    }

    public function setEngineType(string $engineType): self
    {
        $this->engineType = $engineType;
        return $this;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }
}
