<?php

namespace App\Entity;

use App\Repository\ProfesseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProfesseurRepository::class)]
#[ApiResource(normalizationContext:['groups' => ['read']],
itemOperations:['GET'=>["security"=>"is_granted('ROLE_ADMIN')"]],
collectionOperations:['GET'=>["security"=>"is_granted('ROLE_ADMIN')"]])]
class Professeur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(["read"])]
    #[ORM\Column(length: 30)]
    private ?string $nom = null;

    #[Groups(["read"])]
    #[ORM\Column(length: 30)]
    private ?string $prenom = null;

    #[ORM\Column(length: 30)]
    private ?string $rue = null;

    #[ORM\Column(length: 30)]
    private ?string $ville = null;

    #[ORM\Column(length: 30)]
    private ?string $codePostal = null;

    #[ORM\OneToMany(mappedBy: 'referent', targetEntity: Etablissement::class)]
    private Collection $etablissements;

    #[ORM\ManyToMany(targetEntity: Etablissement::class, mappedBy: 'professeurs')]
    private Collection $bahuts;

    public function __construct()
    {
        $this->etablissements = new ArrayCollection();
        $this->bahuts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * @return Collection<int, Etablissement>
     */
    public function getEtablissements(): Collection
    {
        return $this->etablissements;
    }

    public function addEtablissement(Etablissement $etablissement): self
    {
        if (!$this->etablissements->contains($etablissement)) {
            $this->etablissements->add($etablissement);
            $etablissement->setReferent($this);
        }

        return $this;
    }

    public function removeEtablissement(Etablissement $etablissement): self
    {
        if ($this->etablissements->removeElement($etablissement)) {
            // set the owning side to null (unless already changed)
            if ($etablissement->getReferent() === $this) {
                $etablissement->setReferent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Etablissement>
     */
    public function getBahuts(): Collection
    {
        return $this->bahuts;
    }

    public function addBahut(Etablissement $bahut): self
    {
        if (!$this->bahuts->contains($bahut)) {
            $this->bahuts->add($bahut);
            $bahut->addProfesseur($this);
        }

        return $this;
    }

    public function removeBahut(Etablissement $bahut): self
    {
        if ($this->bahuts->removeElement($bahut)) {
            $bahut->removeProfesseur($this);
        }

        return $this;
    }
}
