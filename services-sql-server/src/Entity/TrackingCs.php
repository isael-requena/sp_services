<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TrackingCs
 *
 * @ORM\Table(name="TRACKING_CS", indexes={@ORM\Index(name="IDX_B17712FB6D3DC401", columns={"FK_CS_PUNTO_LR"}), @ORM\Index(name="IDX_B17712FB8CE63AC6", columns={"FK_ESTATUS"})})
 * @ORM\Entity
 */
class TrackingCs
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_TRACKING_CS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTrackingCs;

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
     * @var string|null
     *
     * @ORM\Column(name="FEC_ESTATUS", type="string", nullable=true)
     */
    private $fecEstatus;

    /**
     * @var string|null
     *
     * @ORM\Column(name="FEC_CREACION", type="string", nullable=true)
     */
    private $fecCreacion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="FEC_MODIFICACION", type="string", nullable=true)
     */
    private $fecModificacion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ESTATUS_REGISTRO", type="integer", nullable=true, options={"default"="1"})
     */
    private $estatusRegistro = 1;

    /**
     * @var \CsPuntoLr
     *
     * @ORM\ManyToOne(targetEntity="CsPuntoLr")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_CS_PUNTO_LR", referencedColumnName="ID")
     * })
     */
    private $fkCsPuntoLr;

    /**
     * @var \Estatus
     *
     * @ORM\ManyToOne(targetEntity="Estatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_ESTATUS", referencedColumnName="ID_ESTATUS")
     * })
     */
    private $fkEstatus;

    public function getIdTrackingCs(): ?int
    {
        return $this->idTrackingCs;
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

    public function getFecEstatus(): ?string
    {
        return $this->fecEstatus;
    }

    public function setFecEstatus(?string $fecEstatus): self
    {
        $this->fecEstatus = $fecEstatus;

        return $this;
    }

    public function getFecCreacion(): ?string
    {
        return $this->fecCreacion;
    }

    public function setFecCreacion(?string $fecCreacion): self
    {
        $this->fecCreacion = $fecCreacion;

        return $this;
    }

    public function getFecModificacion(): ?string
    {
        return $this->fecModificacion;
    }

    public function setFecModificacion(?string $fecModificacion): self
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

    public function getFkCsPuntoLr(): ?CsPuntoLr
    {
        return $this->fkCsPuntoLr;
    }

    public function setFkCsPuntoLr(?CsPuntoLr $fkCsPuntoLr): self
    {
        $this->fkCsPuntoLr = $fkCsPuntoLr;

        return $this;
    }

    public function getFkEstatus(): ?Estatus
    {
        return $this->fkEstatus;
    }

    public function setFkEstatus(?Estatus $fkEstatus): self
    {
        $this->fkEstatus = $fkEstatus;

        return $this;
    }


}
