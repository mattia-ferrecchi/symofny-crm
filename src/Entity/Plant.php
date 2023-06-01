<?php

namespace App\Entity;

use App\Repository\PlantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlantRepository::class)]
class Plant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $plant_name = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'Plant')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Site $site = null;

    #[ORM\ManyToOne(inversedBy: 'plant')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Operator $supervisor = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlantName(): ?string
    {
        return $this->plant_name;
    }

    public function setPlantName(string $plant_name): self
    {
        $this->plant_name = $plant_name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSite(): ?Site
    {
        return $this->site;
    }

    public function setSite(?Site $site): self
    {
        $this->site = $site;

        return $this;
    }

    public function getSupervisor(): ?Operator
    {
        return $this->supervisor;
    }

    public function setSupervisor(?Operator $supervisor): self
    {
        $this->supervisor = $supervisor;

        return $this;
    }
}
