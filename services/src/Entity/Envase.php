<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Envase
 *
 * @ORM\Table(name="envase", indexes={@ORM\Index(name="FK_ENVASE_ESTATUS", columns={"FK_ESTATUS"}), @ORM\Index(name="FK_ENVASE_COMPROBANTE_SERVICIO", columns={"FK_COMPROBANTE_SERVICIO"})})
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
     * @ORM\Column(name="COD_ENVASE", type="string", length=15, nullable=true, options={"default"="NULL"})
     */
    private $codEnvase = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FEC_ESCANEO", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $fecEscaneo = 'NULL';

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
     * @var int|null
     *
     * @ORM\Column(name="REGISTRO_MANUAL", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $registroManual = NULL;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ESTATUS_REGISTRO", type="integer", nullable=true, options={"default"="1"})
     */
    private $estatusRegistro = 1;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FEC_ESTATUS", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $fecEstatus = 'NULL';

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

    public function getIdEnvase(): ?int
    {
        return $this->idEnvase;
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

    /*public function getFecEscaneo(): ?\DateTimeInterface
    {
        return $this->fecEscaneo;
    }*/

    public function setFecEscaneo(?\DateTimeInterface $fecEscaneo): self
    {
        $this->fecEscaneo = $fecEscaneo;

        return $this;
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

    public function getRegistroManual(): ?int
    {
        return $this->registroManual;
    }

    public function setRegistroManual(?int $registroManual): self
    {
        $this->registroManual = $registroManual;

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

    /*public function getFecEstatus(): ?\DateTimeInterface
    {
        return $this->fecEstatus;
    }*/

    public function setFecEstatus(?\DateTimeInterface $fecEstatus): self
    {
        $this->fecEstatus = $fecEstatus;

        return $this;
    }

   /* public function getFecCreacion(): ?\DateTimeInterface
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
