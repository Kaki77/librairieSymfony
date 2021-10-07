<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Langue
 *
 * @ORM\Table(name="langue")
 * @ORM\Entity(repositoryClass=App\Repository\LangueRepository::class)
 */
class Langue
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_langue", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLangue;

    /**
     * @var string
     *
     * @ORM\Column(name="langue", type="string", length=45, nullable=false)
     */
    private $langue;

    public function getIdLangue(): ?int
    {
        return $this->idLangue;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): self
    {
        $this->langue = $langue;

        return $this;
    }

    public function __toString()
    {
        return $this->langue;
    }


}
