<?php

namespace App\Entity;

use App\Repository\OperatorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OperatorRepository::class)]
class Operator
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $last_name = null;

    #[ORM\Column(type: Types::BINARY)]
    private $gender = null;

    #[ORM\Column]
    private ?bool $is_main = null;

    #[ORM\OneToMany(mappedBy: 'supervisor', targetEntity: Site::class)]
    private Collection $site;

    #[ORM\OneToMany(mappedBy: 'supervisor', targetEntity: plant::class)]
    private Collection $plant;

    #[ORM\OneToMany(mappedBy: 'operator', targetEntity: contact::class)]
    private Collection $contact;

    public function __construct()
    {
        $this->site = new ArrayCollection();
        $this->plant = new ArrayCollection();
        $this->contact = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return Collection<int, Site>
     */
    public function getSite(): Collection
    {
        return $this->site;
    }

    public function addSite(Site $site): self
    {
        if (!$this->site->contains($site)) {
            $this->site->add($site);
            $site->setSupervisor($this);
        }

        return $this;
    }

    public function removeSite(Site $site): self
    {
        if ($this->site->removeElement($site)) {
            // set the owning side to null (unless already changed)
            if ($site->getSupervisor() === $this) {
                $site->setSupervisor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, plant>
     */
    public function getPlant(): Collection
    {
        return $this->plant;
    }

    public function addPlant(plant $plant): self
    {
        if (!$this->plant->contains($plant)) {
            $this->plant->add($plant);
            $plant->setSupervisor($this);
        }

        return $this;
    }

    public function removePlant(plant $plant): self
    {
        if ($this->plant->removeElement($plant)) {
            // set the owning side to null (unless already changed)
            if ($plant->getSupervisor() === $this) {
                $plant->setSupervisor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, contact>
     */
    public function getContact(): Collection
    {
        return $this->contact;
    }

    public function addContact(contact $contact): self
    {
        if (!$this->contact->contains($contact)) {
            $this->contact->add($contact);
            $contact->setOperator($this);
        }

        return $this;
    }

    public function removeContact(contact $contact): self
    {
        if ($this->contact->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getOperator() === $this) {
                $contact->setOperator(null);
            }
        }

        return $this;
    }
}
