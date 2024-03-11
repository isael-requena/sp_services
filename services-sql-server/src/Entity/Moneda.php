<?php

namespace App\Entity;

use App\Repository\MonedaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MonedaRepository::class)
 */
class Moneda
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $num_divisa;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $nombre_divisa;

    /**
     * @ORM\Column(type="string", length=6, nullable=true)
     */
    private $simbolo_divisa;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $num_valor;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $ind_mon;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $ind_activo;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_desde;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_hasta;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $valor_conv;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumDivisa(): ?int
    {
        return $this->num_divisa;
    }

    public function setNumDivisa(int $num_divisa): self
    {
        $this->num_divisa = $num_divisa;

        return $this;
    }

    public function getNombreDivisa(): ?string
    {
        return $this->nombre_divisa;
    }

    public function setNombreDivisa(?string $nombre_divisa): self
    {
        $this->nombre_divisa = $nombre_divisa;

        return $this;
    }

    public function getSimboloDivisa(): ?string
    {
        return $this->simbolo_divisa;
    }

    public function setSimboloDivisa(?string $simbolo_divisa): self
    {
        $this->simbolo_divisa = $simbolo_divisa;

        return $this;
    }

    public function getNumValor(): ?int
    {
        return $this->num_valor;
    }

    public function setNumValor(?int $num_valor): self
    {
        $this->num_valor = $num_valor;

        return $this;
    }

    public function getIndMon(): ?string
    {
        return $this->ind_mon;
    }

    public function setIndMon(?string $ind_mon): self
    {
        $this->ind_mon = $ind_mon;

        return $this;
    }

    public function getIndActivo(): ?string
    {
        return $this->ind_activo;
    }

    public function setIndActivo(?string $ind_activo): self
    {
        $this->ind_activo = $ind_activo;

        return $this;
    }

    public function getFechaDesde(): ?\DateTimeInterface
    {
        return $this->fecha_desde;
    }

    public function setFechaDesde(?\DateTimeInterface $fecha_desde): self
    {
        $this->fecha_desde = $fecha_desde;

        return $this;
    }

    public function getFechaHasta(): ?\DateTimeInterface
    {
        return $this->fecha_hasta;
    }

    public function setFechaHasta(?\DateTimeInterface $fecha_hasta): self
    {
        $this->fecha_hasta = $fecha_hasta;

        return $this;
    }

    public function getValorConv(): ?float
    {
        return $this->valor_conv;
    }

    public function setValorConv(?float $valor_conv): self
    {
        $this->valor_conv = $valor_conv;

        return $this;
    }
}
