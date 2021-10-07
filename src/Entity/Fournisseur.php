<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fournisseur
 *
 * @ORM\Table(name="fournisseur")
 * @ORM\Entity(repositoryClass=App\Repository\FournisseurRepository::class)
 */
class Fournisseur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_fournisseur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFournisseur;

    /**
     * @var string
     *
     * @ORM\Column(name="code_fournisseur", type="string", length=10, nullable=false)
     */
    private $codeFournisseur;

    /**
     * @var string
     *
     * @ORM\Column(name="raison_sociale", type="string", length=180, nullable=false)
     */
    private $raisonSociale;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=false)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="code_postal", type="string", length=45, nullable=false)
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=45, nullable=false)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=45, nullable=false)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=45, nullable=false)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="site", type="string", length=45, nullable=false)
     */
    private $site;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=45, nullable=false)
     */
    private $mail;

    public function getIdFournisseur(): ?int
    {
        return $this->idFournisseur;
    }

    public function getCodeFournisseur(): ?string
    {
        return $this->codeFournisseur;
    }

    public function setCodeFournisseur(string $codeFournisseur): self
    {
        $this->codeFournisseur = $codeFournisseur;

        return $this;
    }

    public function getRaisonSociale(): ?string
    {
        return $this->raisonSociale;
    }

    public function setRaisonSociale(string $raisonSociale): self
    {
        $this->raisonSociale = $raisonSociale;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

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

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function setSite(string $site): self
    {
        $this->site = $site;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function __toString()
    {
        return $this->raisonSociale;
    }


}
