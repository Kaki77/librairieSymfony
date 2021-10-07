<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormatLivre
 *
 * @ORM\Table(name="format_livre")
 * @ORM\Entity(repositoryClass=App\Repository\FormatLivreRepository::class)
 */
class FormatLivre
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_format_livre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFormatLivre;

    /**
     * @var string
     *
     * @ORM\Column(name="format_livre", type="string", length=45, nullable=false)
     */
    private $formatLivre;

    public function getIdFormatLivre(): ?int
    {
        return $this->idFormatLivre;
    }

    public function getFormatLivre(): ?string
    {
        return $this->formatLivre;
    }

    public function setFormatLivre(string $formatLivre): self
    {
        $this->formatLivre = $formatLivre;

        return $this;
    }

    public function __toString()
{
    return $this->formatLivre;
}

}
