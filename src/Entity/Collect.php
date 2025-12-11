<?php

namespace App\Entity;

use App\Enum\StatutJeuEnum;
use App\Repository\CollectRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CollectRepository::class)]
class Collect
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'collects')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'collects')]
    #[ORM\JoinColumn(nullable: false)]
    private ?JeuVideo $jeuvideo = null;

    #[ORM\Column(length: 20, enumType: StatutJeuEnum::class)]
    private StatutJeuEnum $statut = StatutJeuEnum::POSSEDE;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $dateModifStatut = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2, nullable: true)]
    private ?string $prixAchat = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateAchat = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->statut = StatutJeuEnum::POSSEDE;
        $this->dateModifStatut = new \DateTime();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getJeuvideo(): ?JeuVideo
    {
        return $this->jeuvideo;
    }

    public function setJeuvideo(?JeuVideo $jeuvideo): static
    {
        $this->jeuvideo = $jeuvideo;

        return $this;
    }

    public function getStatut(): StatutJeuEnum
    {
        return $this->statut;
    }

    public function setStatut(StatutJeuEnum $statut): static
    {
        $this->statut = $statut;
        // Mettre à jour automatiquement la date de modification du statut
        $this->dateModifStatut = new \DateTime();

        return $this;
    }

    public function getDateModifStatut(): ?\DateTime
    {
        return $this->dateModifStatut;
    }

    public function setDateModifStatut(\DateTime $dateModifStatut): static
    {
        $this->dateModifStatut = $dateModifStatut;

        return $this;
    }

    public function getPrixAchat(): ?string
    {
        return $this->prixAchat;
    }

    public function setPrixAchat(?string $prixAchat): static
    {
        $this->prixAchat = $prixAchat;

        return $this;
    }

    public function getDateAchat(): ?\DateTime
    {
        return $this->dateAchat;
    }

    public function setDateAchat(?\DateTime $dateAchat): static
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
