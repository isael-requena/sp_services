<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compania
 *
 * @ORM\Table(name="COMPANIA")
 * @ORM\Entity
 */
class Compania
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_COMPANIA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCompania;

    /**
     * @var string|null
     *
     * @ORM\Column(name="RIF", type="string", length=15, nullable=true)
     */
    private $rif;

    /**
     * @var string|null
     *
     * @ORM\Column(name="COD_COMPANIA", type="string", length=5, nullable=true)
     */
    private $codCompania;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NB_CORTO_COMPANIA", type="string", length=10, nullable=true)
     */
    private $nbCortoCompania;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NB_COMPANIA", type="string", length=100, nullable=true)
     */
    private $nbCompania;

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

    public function getIdCompania(): ?int
    {
        return $this->idCompania;
    }

    public function getRif(): ?string
    {
        return $this->rif;
    }

    public function setRif(?string $rif): self
    {
        $this->rif = $rif;

        return $this;
    }

    public function getCodCompania(): ?string
    {
        return $this->codCompania;
    }

    public function setCodCompania(?string $codCompania): self
    {
        $this->codCompania = $codCompania;

        return $this;
    }

    public function getNbCortoCompania(): ?string
    {
        return $this->nbCortoCompania;
    }

    public function setNbCortoCompania(?string $nbCortoCompania): self
    {
        $this->nbCortoCompania = $nbCortoCompania;

        return $this;
    }

    public function getNbCompania(): ?string
    {
        return $this->nbCompania;
    }

    public function setNbCompania(?string $nbCompania): self
    {
        $this->nbCompania = $nbCompania;

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
