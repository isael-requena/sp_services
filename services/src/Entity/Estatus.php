<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estatus
 *
 * @ORM\Table(name="estatus", indexes={@ORM\Index(name="FK_TIPO_ESTATUS", columns={"FK_TIPO_ESTATUS"})})
 * @ORM\Entity
 */
class Estatus
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_ESTATUS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEstatus;

    /**
     * @var int|null
     *
     * @ORM\Column(name="COD_ESTATUS", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $codEstatus = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="REFERENCIA", type="string", length=10, nullable=true, options={"default"="NULL"})
     */
    private $referencia = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="NB_ESTATUS", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $nbEstatus = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="ESTATUS_MAESTRO", type="string", length=20, nullable=true, options={"default"="NULL"})
     */
    private $estatusMaestro = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="ESTATUS_REGISTRO", type="integer", nullable=true, options={"default"="1"})
     */
    private $estatusRegistro = 1;

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
     * @var \TipoEstatus
     *
     * @ORM\ManyToOne(targetEntity="TipoEstatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_TIPO_ESTATUS", referencedColumnName="ID_TIPO_ESTATUS")
     * })
     */
    private $fkTipoEstatus;

    public function getIdEstatus(): ?int
    {
        return $this->idEstatus;
    }

    public function getCodEstatus(): ?int
    {
        return $this->codEstatus;
    }

    public function setCodEstatus(?int $codEstatus): self
    {
        $this->codEstatus = $codEstatus;

        return $this;
    }

    public function getReferencia(): ?string
    {
        return $this->referencia;
    }

    public function setReferencia(?string $referencia): self
    {
        $this->referencia = $referencia;

        return $this;
    }

    public function getNbEstatus(): ?string
    {
        return $this->nbEstatus;
    }

    public function setNbEstatus(?string $nbEstatus): self
    {
        $this->nbEstatus = $nbEstatus;

        return $this;
    }

    /*public function getEstatusMaestro(): ?string
    {
        return $this->estatusMaestro;
    }*/

    public function setEstatusMaestro(?string $estatusMaestro): self
    {
        $this->estatusMaestro = $estatusMaestro;

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

    /*public function getFkTipoEstatus(): ?TipoEstatus
    {
        return $this->fkTipoEstatus;
    }*/

    public function setFkTipoEstatus(?TipoEstatus $fkTipoEstatus): self
    {
        $this->fkTipoEstatus = $fkTipoEstatus;

        return $this;
    }


}
