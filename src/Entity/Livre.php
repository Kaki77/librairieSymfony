<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Livre
 *
 * @ORM\Table(name="livre", indexes={@ORM\Index(name="id_editeur", columns={"id_editeur"}), @ORM\Index(name="index_format_livre", columns={"id_format_livre"}), @ORM\Index(name="id_langue", columns={"id_langue"})})
 * @ORM\Entity(repositoryClass=App\Repository\LivreRepository::class)
 */
class Livre
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_livre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLivre;

    /**
     * @var int
     *
     * @ORM\Column(name="isbn", type="integer", nullable=false)
     */
    private $isbn;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_livre", type="string", length=180, nullable=false)
     */
    private $titreLivre;

    /**
     * @var int
     *
     * @ORM\Column(name="page_livre", type="integer", nullable=false)
     */
    private $pageLivre;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_auteur", type="string", length=180, nullable=false)
     */
    private $nomAuteur;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_auteur", type="string", length=180, nullable=false)
     */
    private $prenomAuteur;

    /**
     * @var string
     *
     * @ORM\Column(name="annee_edition", type="string", length=45, nullable=false)
     */
    private $anneeEdition;

    /**
     * @var int
     *
     * @ORM\Column(name="prix_livre", type="integer", nullable=false)
     */
    private $prixLivre;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var string
     *
     * @ORM\Column(name="image_livre", type="string", length=255, nullable=true)
     */
    private $imageLivre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ajout", type="date", nullable=true)
     */
    private $dateAjout;

    /**
     * @var \Editeur
     *
     * @ORM\ManyToOne(targetEntity="Editeur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_editeur", referencedColumnName="id_editeur")
     * })
     */

    

    private $idEditeur;

    /**
     * @var \FormatLivre
     *
     * @ORM\ManyToOne(targetEntity="FormatLivre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_format_livre", referencedColumnName="id_format_livre")
     * })
     */
    private $idFormatLivre;

    /**
     * @var \Langue
     *
     * @ORM\ManyToOne(targetEntity="Langue")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_langue", referencedColumnName="id_langue")
     * })
     */
    private $idLangue;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Reservation", inversedBy="idLivre")
     * @ORM\JoinTable(name="livre_has_reservation",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_livre", referencedColumnName="id_livre")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_reservation", referencedColumnName="id_reservation")
     *   }
     * )
     */
    private $idReservation;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ThemeLivre", inversedBy="idLivre")
     * @ORM\JoinTable(name="livre_has_theme",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_livre", referencedColumnName="id_livre")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_theme_livre", referencedColumnName="id_theme_livre")
     *   }
     * )
     */
    private $idThemeLivre;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idReservation = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idThemeLivre = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdLivre(): ?int
    {
        return $this->idLivre;
    }

    public function getIsbn(): ?int
    {
        return $this->isbn;
    }

    public function setIsbn(int $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getTitreLivre(): ?string
    {
        return $this->titreLivre;
    }

    public function setTitreLivre(string $titreLivre): self
    {
        $this->titreLivre = $titreLivre;

        return $this;
    }

    public function getPageLivre(): ?int
    {
        return $this->pageLivre;
    }

    public function setPageLivre(int $pageLivre): self
    {
        $this->pageLivre = $pageLivre;

        return $this;
    }

    public function getNomAuteur(): ?string
    {
        return $this->nomAuteur;
    }

    public function setNomAuteur(string $nomAuteur): self
    {
        $this->nomAuteur = $nomAuteur;

        return $this;
    }

    public function getPrenomAuteur(): ?string
    {
        return $this->prenomAuteur;
    }

    public function setPrenomAuteur(string $prenomAuteur): self
    {
        $this->prenomAuteur = $prenomAuteur;

        return $this;
    }

    public function getAnneeEdition(): ?string
    {
        return $this->anneeEdition;
    }

    public function setAnneeEdition(string $anneeEdition): self
    {
        $this->anneeEdition = $anneeEdition;

        return $this;
    }

    public function getPrixLivre(): ?int
    {
        return $this->prixLivre;
    }

    public function setPrixLivre(int $prixLivre): self
    {
        $this->prixLivre = $prixLivre;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getImageLivre(): ?string
    {
        return $this->imageLivre;
    }

    public function setImageLivre(string $imageLivre): self
    {
        $this->imageLivre = $imageLivre;

        return $this;
    }

    public function getDateAjout(): ?\DateTimeInterface
    {
        return $this->dateAjout;
    }

    public function setDateAjout(\DateTimeInterface $dateAjout): self
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }

    public function getIdEditeur(): ?Editeur
    {
        return $this->idEditeur;
    }

    public function setIdEditeur(?Editeur $idEditeur): self
    {
        $this->idEditeur = $idEditeur;

        return $this;
    }

    public function getIdFormatLivre(): ?FormatLivre
    {
        return $this->idFormatLivre;
    }

    public function setIdFormatLivre(?FormatLivre $idFormatLivre): self
    {
        $this->idFormatLivre = $idFormatLivre;

        return $this;
    }

    public function getIdLangue(): ?Langue
    {
        return $this->idLangue;
    }

    public function setIdLangue(?Langue $idLangue): self
    {
        $this->idLangue = $idLangue;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getIdReservation(): Collection
    {
        return $this->idReservation;
    }

    public function addIdReservation(Reservation $idReservation): self
    {
        if (!$this->idReservation->contains($idReservation)) {
            $this->idReservation[] = $idReservation;
        }

        return $this;
    }

    public function removeIdReservation(Reservation $idReservation): self
    {
        $this->idReservation->removeElement($idReservation);

        return $this;
    }

    /**
     * @return Collection|ThemeLivre[]
     */
    public function getIdThemeLivre(): Collection
    {
        return $this->idThemeLivre;
    }

    public function addIdThemeLivre(ThemeLivre $idThemeLivre): self
    {
        if (!$this->idThemeLivre->contains($idThemeLivre)) {
            $this->idThemeLivre[] = $idThemeLivre;
        }

        return $this;
    }

    public function removeIdThemeLivre(ThemeLivre $idThemeLivre): self
    {
        $this->idThemeLivre->removeElement($idThemeLivre);

        return $this;
    }

    public function __toString()
    {
        return $this->titreLivre;
    }

}
