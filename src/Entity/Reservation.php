<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="fk_reservation_user", columns={"id_user"})})
 * @ORM\Entity(repositoryClass=App\Repository\ReservationRepository::class)
 */
class Reservation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_reservation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReservation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_reservation", type="date", nullable=false)
     */
    private $dateReservation;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_reservation", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixReservation;

    /**
     * @var bool
     *
     * @ORM\Column(name="est_paye", type="boolean", nullable=false)
     */
    private $estPaye;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     * })
     */
    private $idUser;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Livre", mappedBy="idReservation")
     */
    private $idLivre;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idLivre = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdReservation(): ?int
    {
        return $this->idReservation;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->dateReservation;
    }

    public function setDateReservation(\DateTimeInterface $dateReservation): self
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    public function getPrixReservation(): ?float
    {
        return $this->prixReservation;
    }

    public function setPrixReservation(float $prixReservation): self
    {
        $this->prixReservation = $prixReservation;

        return $this;
    }

    public function getEstPaye(): ?bool
    {
        return $this->estPaye;
    }

    public function setEstPaye(bool $estPaye): self
    {
        $this->estPaye = $estPaye;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * @return Collection|Livre[]
     */
    public function getIdLivre(): Collection
    {
        return $this->idLivre;
    }

    public function addIdLivre(Livre $idLivre): self
    {
        if (!$this->idLivre->contains($idLivre)) {
            $this->idLivre[] = $idLivre;
            $idLivre->addIdReservation($this);
        }

        return $this;
    }

    public function removeIdLivre(Livre $idLivre): self
    {
        if ($this->idLivre->removeElement($idLivre)) {
            $idLivre->removeIdReservation($this);
        }

        return $this;
    }

}
