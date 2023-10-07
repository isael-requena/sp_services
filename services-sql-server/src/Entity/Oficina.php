<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Oficina
 *
 * @ORM\Table(name="OFICINA", indexes={@ORM\Index(name="IDX_3A065BB679831C8F", columns={"FK_COMPANIA"}), @ORM\Index(name="IDX_3A065BB6A4B3BE95", columns={"FK_REGION"})})
 * @ORM\Entity
 */
class Oficina
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_OFICINA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOficina;

    /**
     * @var string|null
     *
     * @ORM\Column(name="COD_OFICINA", type="string", length=5, nullable=true)
     */
    private $codOficina;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NB_OFICINA", type="string", length=50, nullable=true)
     */
    private $nbOficina;

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
     * @var \DateTime|null
     *
     * @ORM\Column(name="FEC_ESTATUS", type="datetime", nullable=true)
     */
    private $fecEstatus;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ESTATUS_REGISTRO", type="integer", nullable=true, options={"default"="1"})
     */
    private $estatusRegistro = 1;

    /**
     * @var \Compania
     *
     * @ORM\ManyToOne(targetEntity="Compania")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_COMPANIA", referencedColumnName="ID_COMPANIA")
     * })
     */
    private $fkCompania;

    /**
     * @var \Region
     *
     * @ORM\ManyToOne(targetEntity="Region")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_REGION", referencedColumnName="ID_REGION")
     * })
     */
    private $fkRegion;

    public function getIdOficina(): ?int
    {
        return $this->idOficina;
    }

    public function getCodOficina(): ?string
    {
        return $this->codOficina;
    }

    public function setCodOficina(?string $codOficina): self
    {
        $this->codOficina = $codOficina;

        return $this;
    }

    public function getNbOficina(): ?string
    {
        return $this->nbOficina;
    }

    public function setNbOficina(?string $nbOficina): self
    {
        $this->nbOficina = $nbOficina;

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

    public function getFecEstatus(): ?\DateTimeInterface
    {
        return $this->fecEstatus;
    }

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

    public function getFkCompania(): ?Compania
    {
        return $this->fkCompania;
    }

    public function setFkCompania(?Compania $fkCompania): self
    {
        $this->fkCompania = $fkCompania;

        return $this;
    }

    public function getFkRegion(): ?Region
    {
        return $this->fkRegion;
    }

    public function setFkRegion(?Region $fkRegion): self
    {
        $this->fkRegion = $fkRegion;

        return $this;
    }


}
