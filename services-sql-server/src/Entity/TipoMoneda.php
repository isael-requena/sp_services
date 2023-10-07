<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoMoneda
 *
 * @ORM\Table(name="TIPO_MONEDA")
 * @ORM\Entity
 */
class TipoMoneda
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_TIPO_MONEDA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTipoMoneda;

    /**
     * @var int|null
     *
     * @ORM\Column(name="COD_MONEDA", type="integer", nullable=true)
     */
    private $codMoneda;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DENOMINACION", type="string", length=5, nullable=true)
     */
    private $denominacion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NB_TIPO_MONEDA", type="string", length=20, nullable=true)
     */
    private $nbTipoMoneda;

    /**
     * @var string|null
     *
     * @ORM\Column(name="USUARIO_CREACION", type="string", length=20, nullable=true)
     */
    private $usuarioCreacion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="USUARIO_MODIFICACION", type="string", length=20, nullable=true)
     */
    private $usuarioModificacion;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FEC_ESTATUS", type="datetime", nullable=true)
     */
    private $fecEstatus;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FEC_CREACION", type="datetime", nullable=true)
     */
    private $fecCreacion;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FEC_MODIFICACION", type="datetime", nullable=true)
     */
    private $fecModificacion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ESTATUS_REGISTRO", type="integer", nullable=true, options={"default"="1"})
     */
    private $estatusRegistro = 1;

    public function getIdTipoMoneda(): ?int
    {
        return $this->idTipoMoneda;
    }

    public function getCodMoneda(): ?int
    {
        return $this->codMoneda;
    }

    public function setCodMoneda(?int $codMoneda): self
    {
        $this->codMoneda = $codMoneda;

        return $this;
    }

    public function getDenominacion(): ?string
    {
        return $this->denominacion;
    }

    public function setDenominacion(?string $denominacion): self
    {
        $this->denominacion = $denominacion;

        return $this;
    }

    public function getNbTipoMoneda(): ?string
    {
        return $this->nbTipoMoneda;
    }

    public function setNbTipoMoneda(?string $nbTipoMoneda): self
    {
        $this->nbTipoMoneda = $nbTipoMoneda;

        return $this;
    }

    public function getUsuarioCreacion(): ?string
    {
        return $this->usuarioCreacion;
    }

    public function setUsuarioCreacion(?string $usuarioCreacion): self
    {
        $this->usuarioCreacion = $usuarioCreacion;

        return $this;
    }

    public function getUsuarioModificacion(): ?string
    {
        return $this->usuarioModificacion;
    }

    public function setUsuarioModificacion(?string $usuarioModificacion): self
    {
        $this->usuarioModificacion = $usuarioModificacion;

        return $this;
    }

    public function getFecEstatus(): ?\DateTimeInterface
    {
        return $this->fecEstatus;
    }

    public function setFecEstatus(?\DateTimeInterface $fecEstatus): self
    {
        $this->fecEstatus = $fecEstatus;

        return $this;
    }

    public function getFecCreacion(): ?\DateTimeInterface
    {
        return $this->fecCreacion;
    }

    public function setFecCreacion(?\DateTimeInterface $fecCreacion): self
    {
        $this->fecCreacion = $fecCreacion;

        return $this;
    }

    public function getFecModificacion(): ?\DateTimeInterface
    {
        return $this->fecModificacion;
    }

    public function setFecModificacion(?\DateTimeInterface $fecModificacion): self
    {
        $this->fecModificacion = $fecModificacion;

        return $this;
    }

    public function getEstatusRegistro(): ?int
    {
        return $this->estatusRegistro;
    }

    public function setEstatusRegistro(?int $estatusRegistro): self
    {
        $this->estatusRegistro = $estatusRegistro;

        return $this;
    }


}
