<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $legal_name = null;

    #[ORM\Column(length: 255)]
    private ?string $vat_number = null;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: Site::class, orphanRemoval: true)]
    private Collection $sites;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: Contact::class)]
    private Collection $contact;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: Address::class, cascade: ['persist', 'remove'])]
    private Collection $address;

    public function __construct()
    {
        $this->sites = new ArrayCollection();
        $this->contact = new ArrayCollection();
        $this->address = new ArrayCollection();
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

    public function getVatNumber(): ?string
    {
        return $this->vat_number;
    }

    public function setVatNumber(string $vat_number): self
    {
        $this->vat_number = $vat_number;

        return $this;
    }

    /**
     * @return Collection<int, site>
     */
    public function getSites(): Collection
    {
        return $this->sites;
    }

    public function addSite(site $site): self
    {
        if (!$this->sites->contains($site)) {
            $this->sites->add($site);
            $site->setCompany($this);
        }

        return $this;
    }

    public function removeSite(site $site): self
    {
        if ($this->sites->removeElement($site)) {
            // set the owning side to null (unless already changed)
            if ($site->getCompany() === $this) {
                $site->setCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Contact>
     */
    public function getContact(): Collection
    {
        return $this->contact;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contact->contains($contact)) {
            $this->contact->add($contact);
            $contact->setCompany($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contact->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getCompany() === $this) {
                $contact->setCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, address>
     */
    public function getAddress(): Collection
    {
        return $this->address;
    }

    public function addAddress(address $address): self
    {
        if (!$this->address->contains($address)) {
            $this->address->add($address);
            $address->setCompany($this);
        }

        return $this;
    }

    public function removeAddress(address $address): self
    {
        if ($this->address->removeElement($address)) {
            // set the owning side to null (unless already changed)
            if ($address->getCompany() === $this) {
                $address->setCompany(null);
            }
        }

        return $this;
    }
}
