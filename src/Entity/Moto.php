<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Moto
{
    #[Assert\NotBlank(message: "Le nom du modèle est obligatoire")]
    #[Assert\Length(min: 2, max: 100)]
    private ?string $name = null;

    #[Assert\NotBlank(message: "La description est obligatoire")]
    #[Assert\Length(min: 10)]
    private ?string $description = null;

    #[Assert\NotBlank(message: "La cylindrée est obligatoire")]
    #[Assert\Positive(message: "La cylindrée doit être positive")]
    private ?int $engine = null;

    #[Assert\NotBlank(message: "Le prix est obligatoire")]
    #[Assert\Positive(message: "Le prix doit être positif")]
    private ?float $price = null;

    #[Assert\NotBlank(message: "L'année de fabrication est obligatoire")]
    #[Assert\Type("integer")]

    private ?int $year = null;
    // Getters & Setters

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getEngine(): ?int
    {
        return $this->engine;
    }

    public function setEngine(int $engine): self
    {
        $this->engine = $engine;
        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getYear(): ?int 
    { 
        return $this->year;  
    }

    public function setYear(int $year): self 
    { 
        $this->year = $year; 
        return $this; 
    }
}

