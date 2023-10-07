<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CsPuntoLr
 *
 * @ORM\Table(name="CS_PUNTO_LR", indexes={@ORM\Index(name="IDX_7AD15B18DEC6AF86", columns={"FK_TIPO_OPERACION"}), @ORM\Index(name="IDX_7AD15B188B024B78", columns={"FK_CAUSA_NO_EJECUCION"}), @ORM\Index(name="IDX_7AD15B189AEF413", columns={"FK_COMPROBANTE_SERVICIO"}), @ORM\Index(name="IDX_7AD15B188CE63AC6", columns={"FK_ESTATUS"}), @ORM\Index(name="IDX_7AD15B18DEBA9723", columns={"FK_PUNTOLR"})})
 * @ORM\Entity
 */
class CsPuntoLr
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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
     * @var string|null
     *
     * @ORM\Column(name="FEC_ESTATUS", type="string", nullable=true)
     */
    private $fecEstatus;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ESTATUS_REGISTRO", type="integer", nullable=true, options={"default"="1"})
     */
    private $estatusRegistro = 1;

    /**
     * @var \TipoOperacion
     *
     * @ORM\ManyToOne(targetEntity="TipoOperacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_TIPO_OPERACION", referencedColumnName="ID_TIPO_OPERACION")
     * })
     */
    private $fkTipoOperacion;

    /**
     * @var \CausaNoEjecucion
     *
     * @ORM\ManyToOne(targetEntity="CausaNoEjecucion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_CAUSA_NO_EJECUCION", referencedColumnName="ID_CAUSA_NO_EJECUCION")
     * })
     */
    private $fkCausaNoEjecucion;

    /**
     * @var \ComprobanteServicio
     *
     * @ORM\ManyToOne(targetEntity="ComprobanteServicio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_COMPROBANTE_SERVICIO", referencedColumnName="ID_COMPROBANTE_SERVICIO")
     * })
     */
    private $fkComprobanteServicio;

    /**
     * @var \Estatus
     *
     * @ORM\ManyToOne(targetEntity="Estatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_ESTATUS", referencedColumnName="ID_ESTATUS")
     * })
     */
    private $fkEstatus;

    /**
     * @var \PuntoLr
     *
     * @ORM\ManyToOne(targetEntity="PuntoLr")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_PUNTOLR", referencedColumnName="ID_PUNTO_LR")
     * })
     */
    private $fkPuntolr;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFecEstatus(): ?string
    {
        return $this->fecEstatus;
    }

    public function setFecEstatus(?string $fecEstatus): self
    {
        $this->fecEstatus = $fecEstatus;

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

    public function getFkTipoOperacion(): ?TipoOperacion
    {
        return $this->fkTipoOperacion;
    }

    public function setFkTipoOperacion(?TipoOperacion $fkTipoOperacion): self
    {
        $this->fkTipoOperacion = $fkTipoOperacion;

        return $this;
    }

    public function getFkCausaNoEjecucion(): ?CausaNoEjecucion
    {
        return $this->fkCausaNoEjecucion;
    }

    public function setFkCausaNoEjecucion(?CausaNoEjecucion $fkCausaNoEjecucion): self
    {
        $this->fkCausaNoEjecucion = $fkCausaNoEjecucion;

        return $this;
    }

    public function getFkComprobanteServicio(): ?ComprobanteServicio
    {
        return $this->fkComprobanteServicio;
    }

    public function setFkComprobanteServicio(?ComprobanteServicio $fkComprobanteServicio): self
    {
        $this->fkComprobanteServicio = $fkComprobanteServicio;

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

    public function getFkPuntolr(): ?PuntoLr
    {
        return $this->fkPuntolr;
    }

    public function setFkPuntolr(?PuntoLr $fkPuntolr): self
    {
        $this->fkPuntolr = $fkPuntolr;

        return $this;
    }


}
