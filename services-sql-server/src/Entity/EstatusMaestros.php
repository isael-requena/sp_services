<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EstatusMaestros
 *
 * @ORM\Table(name="ESTATUS_MAESTROS")
 * @ORM\Entity
 */
class EstatusMaestros
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_ESTATUS_MAESTROS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEstatusMaestros;

    /**
     * @var string|null
     *
     * @ORM\Column(name="COD_ESTATUS", type="string", length=5, nullable=true)
     */
    private $codEstatus;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DESCRIPCION", type="string", length=20, nullable=true)
     */
    private $descripcion;

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

    public function getIdEstatusMaestros(): ?int
    {
        return $this->idEstatusMaestros;
    }

    public function getCodEstatus(): ?string
    {
        return $this->codEstatus;
    }

    public function setCodEstatus(?string $codEstatus): self
    {
        $this->codEstatus = $codEstatus;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

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
