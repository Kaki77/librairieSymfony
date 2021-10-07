<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ThemeLivre
 *
 * @ORM\Table(name="theme_livre")
 * @ORM\Entity(repositoryClass=App\Repository\ThemeLivreRepository::class)
 */
class ThemeLivre
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_theme_livre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idThemeLivre;

    /**
     * @var string
     *
     * @ORM\Column(name="theme_livre", type="string", length=45, nullable=false)
     */
    private $themeLivre;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Livre", mappedBy="idThemeLivre")
     */
    private $idLivre;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idLivre = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdThemeLivre(): ?int
    {
        return $this->idThemeLivre;
    }

    public function getThemeLivre(): ?string
    {
        return $this->themeLivre;
    }

    public function setThemeLivre(string $themeLivre): self
    {
        $this->themeLivre = $themeLivre;

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
            $idLivre->addIdThemeLivre($this);
        }

        return $this;
    }

    public function removeIdLivre(Livre $idLivre): self
    {
        if ($this->idLivre->removeElement($idLivre)) {
            $idLivre->removeIdThemeLivre($this);
        }

        return $this;
    }

    public function __toString()
{
    return $this->themeLivre;
}
}
