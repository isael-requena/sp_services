<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transporte
 *
 * @ORM\Table(name="TRANSPORTE", indexes={@ORM\Index(name="IDX_38F5C18BEDDBCB17", columns={"FK_TIPO_TRANSPORTE"})})
 * @ORM\Entity
 */
class Transporte
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_TRANSPORTE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTransporte;

    /**
     * @var string|null
     *
     * @ORM\Column(name="COD_UNIDAD", type="string", length=10, nullable=true)
     */
    private $codUnidad;

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
     * @ORM\Column(name="ESTATUS_REGISTRO", type="integer", nullable=true)
     */
    private $estatusRegistro;

    /**
     * @var \TipoTransporte
     *
     * @ORM\ManyToOne(targetEntity="TipoTransporte")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_TIPO_TRANSPORTE", referencedColumnName="ID_TIPO_TRANSPORTE")
     * })
     */
    private $fkTipoTransporte;

    public function getIdTransporte(): ?int
    {
        return $this->idTransporte;
    }

    public function getCodUnidad(): ?string
    {
        return $this->codUnidad;
    }

    public function setCodUnidad(?string $codUnidad): self
    {
        $this->codUnidad = $codUnidad;

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

    public function getFkTipoTransporte(): ?TipoTransporte
    {
        return $this->fkTipoTransporte;
    }

    public function setFkTipoTransporte(?TipoTransporte $fkTipoTransporte): self
    {
        $this->fkTipoTransporte = $fkTipoTransporte;

        return $this;
    }


}
