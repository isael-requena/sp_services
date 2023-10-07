<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Municipio
 *
 * @ORM\Table(name="MUNICIPIO", indexes={@ORM\Index(name="IDX_BA5AEB0F25574A7D", columns={"FK_CIUDAD"})})
 * @ORM\Entity
 */
class Municipio
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_MUNICIPIO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMunicipio;

    /**
     * @var int|null
     *
     * @ORM\Column(name="COD_MUNICIPIO", type="integer", nullable=true)
     */
    private $codMunicipio;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NB_MUNICIPIO", type="string", length=50, nullable=true)
     */
    private $nbMunicipio;

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

    /**
     * @var \Ciudad
     *
     * @ORM\ManyToOne(targetEntity="Ciudad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_CIUDAD", referencedColumnName="ID_CIUDAD")
     * })
     */
    private $fkCiudad;

    public function getIdMunicipio(): ?int
    {
        return $this->idMunicipio;
    }

    public function getCodMunicipio(): ?int
    {
        return $this->codMunicipio;
    }

    public function setCodMunicipio(?int $codMunicipio): self
    {
        $this->codMunicipio = $codMunicipio;

        return $this;
    }

    public function getNbMunicipio(): ?string
    {
        return $this->nbMunicipio;
    }

    public function setNbMunicipio(?string $nbMunicipio): self
    {
        $this->nbMunicipio = $nbMunicipio;

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

    public function getFkCiudad(): ?Ciudad
    {
        return $this->fkCiudad;
    }

    public function setFkCiudad(?Ciudad $fkCiudad): self
    {
        $this->fkCiudad = $fkCiudad;

        return $this;
    }


}
