<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Envase
 *
 * @ORM\Table(name="ENVASE", indexes={@ORM\Index(name="IDX_18AD0559AEF413", columns={"FK_COMPROBANTE_SERVICIO"}), @ORM\Index(name="IDX_18AD0558CE63AC6", columns={"FK_ESTATUS"})})
 * @ORM\Entity
 */
class Envase
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_ENVASE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEnvase;

    /**
     * @var string|null
     *
     * @ORM\Column(name="COD_ENVASE", type="string", length=15, nullable=true)
     */
    private $codEnvase;

    /**
     * @var string|null
     *
     * @ORM\Column(name="FEC_ESCANEO", type="string", nullable=true)
     */
    private $fecEscaneo;

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
     * @var int|null
     *
     * @ORM\Column(name="ESTATUS_REGISTRO", type="integer", nullable=true, options={"default"="1"})
     */
    private $estatusRegistro = 1;

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
     * @var int|null
     *
     * @ORM\Column(name="REGISTRO_MANUAL", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $registroManual = NULL;

    public function getIdEnvase(): ?int
    {
        return $this->idEnvase;
    }

    public function getRegistroManual(): ?int
    {
        return $this->registroManual;
    }

    public function setRegistroManual(?int $registroManual): self
    {
        $this->registroManual = $registroManual;

        return $this;
    }

    public function getCodEnvase(): ?string
    {
        return $this->codEnvase;
    }

    public function setCodEnvase(?string $codEnvase): self
    {
        $this->codEnvase = $codEnvase;

        return $this;
    }

    /*public function getFecEscaneo(): ?string
    {
        return $this->fecEscaneo;
    }*/

    public function setFecEscaneo(?string $fecEscaneo): self
    {
        $this->fecEscaneo = $fecEscaneo;

        return $this;
    }

   /* public function getUsuarioCreacion(): ?string
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

    public function getEstatusRegistro(): ?int
    {
        return $this->estatusRegistro;
    }

    public function setEstatusRegistro(?int $estatusRegistro): self
    {
        $this->estatusRegistro = $estatusRegistro;

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

    public function getFkComprobanteServicio(): ?ComprobanteServicio
    {
        return $this->fkComprobanteServicio;
    }

    public function setFkComprobanteServicio(?ComprobanteServicio $fkComprobanteServicio): self
    {
        $this->fkComprobanteServicio = $fkComprobanteServicio;

        return $this;
    }

    public function getFkEstatus(): ?String
    {
        return $this->fkEstatus->getNbEstatus();
    }

    public function setFkEstatus(?Estatus $fkEstatus): self
    {
        $this->fkEstatus = $fkEstatus;

        return $this;
    }


}
