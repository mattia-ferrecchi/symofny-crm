<?php

namespace App\Entity;

use App\Repository\SiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SiteRepository::class)]
class Site
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $legal_name = null;

    #[ORM\ManyToOne(inversedBy: 'sites')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Company $company = null;

    #[ORM\ManyToOne(inversedBy: 'site')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Operator $supervisor = null;

    #[ORM\OneToOne(inversedBy: 'site', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?address $address = null;

    #[ORM\OneToMany(mappedBy: 'site', targetEntity: Plant::class, orphanRemoval: true)]
    private Collection $plant;

    public function __construct()
    {
        $this->plant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLegalName(): ?string
    {
        return $this->legal_name;
    }

    public function setLegalName(string $legal_name): self
    {
        $this->legal_name = $legal_name;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

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

    public function getAddress(): ?address
    {
        return $this->address;
    }

    public function setAddress(address $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection<int, Plant>
     */
    public function getPlant(): Collection
    {
        return $this->plant;
    }

    public function addPlant(Plant $plant): self
    {
        if (!$this->plant->contains($plant)) {
            $this->plant->add($plant);
            $plant->setSite($this);
        }

        return $this;
    }

    public function removePlant(Plant $plant): self
    {
        if ($this->plant->removeElement($plant)) {
            // set the owning side to null (unless already changed)
            if ($plant->getSite() === $this) {
                $plant->setSite(null);
            }
        }

        return $this;
    }
}
