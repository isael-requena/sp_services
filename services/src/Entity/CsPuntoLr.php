<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CsPuntoLr
 *
 * @ORM\Table(name="cs_punto_lr", indexes={@ORM\Index(name="FK_CS_PUNTO_LR_TIPO_OPERACION", columns={"FK_TIPO_OPERACION"}), @ORM\Index(name="FK_CS_PUNTO_LR_CAUSA_NO_EJECUCION", columns={"FK_CAUSA_NO_EJECUCION"}), @ORM\Index(name="FK_CS_PUNTO_LR_COMPROBANTE_SERVICIO", columns={"FK_COMPROBANTE_SERVICIO"}), @ORM\Index(name="FK_CS_PUNTO_LR_ESTATUS", columns={"FK_ESTATUS"}), @ORM\Index(name="FK_CS_PUNTO_LR_PUNTOLR", columns={"FK_PUNTOLR"})})
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
     * @ORM\Column(name="USUARIO_CREACION", type="string", length=20, nullable=true, options={"default"="NULL"})
     */
    private $usuarioCreacion = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="USUARIO_MODIFICACION", type="string", length=20, nullable=true, options={"default"="NULL"})
     */
    private $usuarioModificacion = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FEC_CREACION", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $fecCreacion = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FEC_MODIFICACION", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $fecModificacion = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FEC_ESTATUS", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $fecEstatus = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="ESTATUS_REGISTRO", type="integer", nullable=true, options={"default"="1"})
     */
    private $estatusRegistro = 1;

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
     * @var \TipoOperacion
     *
     * @ORM\ManyToOne(targetEntity="TipoOperacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_TIPO_OPERACION", referencedColumnName="ID_TIPO_OPERACION")
     * })
     */
    private $fkTipoOperacion;

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
     * @var \CausaNoEjecucion
     *
     * @ORM\ManyToOne(targetEntity="CausaNoEjecucion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_CAUSA_NO_EJECUCION", referencedColumnName="ID_CAUSA_NO_EJECUCION")
     * })
     */
    private $fkCausaNoEjecucion;

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

    /*public function getUsuarioCreacion(): ?string
    {
        return $this->usuarioCreacion;
    }*/

    public function setUsuarioCreacion(?string $usuarioCreacion): self
    {
        $this->usuarioCreacion = $usuarioCreacion;

        return $this;
    }

    /*public function getUsuarioModificacion(): ?string
    {
        return $this->usuarioModificacion;
    }*/

    public function setUsuarioModificacion(?string $usuarioModificacion): self
    {
        $this->usuarioModificacion = $usuarioModificacion;

        return $this;
    }

    /*public function getFecCreacion(): ?\DateTimeInterface
    {
        return $this->fecCreacion;
    }*/

    public function setFecCreacion(?\DateTimeInterface $fecCreacion): self
    {
        $this->fecCreacion = $fecCreacion;

        return $this;
    }

    /*public function getFecModificacion(): ?\DateTimeInterface
    {
        return $this->fecModificacion;
    }*/

    public function setFecModificacion(?\DateTimeInterface $fecModificacion): self
    {
        $this->fecModificacion = $fecModificacion;

        return $this;
    }

    /*public function getFecEstatus(): ?\DateTimeInterface
    {
        return $this->fecEstatus;
    }*/

    public function setFecEstatus(?\DateTimeInterface $fecEstatus): self
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

    public function getFkComprobanteServicio(): ?ComprobanteServicio
    {
        return $this->fkComprobanteServicio;
    }

    public function setFkComprobanteServicio(?ComprobanteServicio $fkComprobanteServicio): self
    {
        $this->fkComprobanteServicio = $fkComprobanteServicio;

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

    public function getFkEstatus(): ?Estatus
    {
        return $this->fkEstatus;
    }

    public function setFkEstatus(?Estatus $fkEstatus): self
    {
        $this->fkEstatus = $fkEstatus;

        return $this;
    }

    /*public function getFkCausaNoEjecucion(): ?CausaNoEjecucion
    {
        return $this->fkCausaNoEjecucion;
    }*/

    public function setFkCausaNoEjecucion(?CausaNoEjecucion $fkCausaNoEjecucion): self
    {
        $this->fkCausaNoEjecucion = $fkCausaNoEjecucion;

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
