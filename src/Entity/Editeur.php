<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Editeur
 *
 * @ORM\Table(name="editeur")
 * @ORM\Entity(repositoryClass=App\Repository\EditeurRepository::class)
 */
class Editeur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_editeur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEditeur;

    /**
     * @var string
     *
     * @ORM\Column(name="editeur", type="string", length=180, nullable=false)
     */
    private $editeur;

    public function getIdEditeur(): ?int
    {
        return $this->idEditeur;
    }

    public function getEditeur(): ?string
    {
        return $this->editeur;
    }

    public function setEditeur(string $editeur): self
    {
        $this->editeur = $editeur;

        return $this;
    }

    public function __toString()
{
    return $this->editeur;
}

}
