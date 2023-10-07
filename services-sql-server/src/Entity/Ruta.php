<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ruta
 *
 * @ORM\Table(name="RUTA", indexes={@ORM\Index(name="IDX_F53B1D38785E7E9", columns={"FK_OFICINA"})})
 * @ORM\Entity
 */
class Ruta
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_RUTA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRuta;

    /**
     * @var string|null
     *
     * @ORM\Column(name="COD_RUTA", type="string", length=5, nullable=true)
     */
    private $codRuta;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NB_RUTA", type="string", length=100, nullable=true)
     */
    private $nbRuta;

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
     * @var \Oficina
     *
     * @ORM\ManyToOne(targetEntity="Oficina")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_OFICINA", referencedColumnName="ID_OFICINA")
     * })
     */
    private $fkOficina;

    public function getIdRuta(): ?int
    {
        return $this->idRuta;
    }

    public function getCodRuta(): ?string
    {
        return $this->codRuta;
    }

    public function setCodRuta(?string $codRuta): self
    {
        $this->codRuta = $codRuta;

        return $this;
    }

    public function getNbRuta(): ?string
    {
        return $this->nbRuta;
    }

    public function setNbRuta(?string $nbRuta): self
    {
        $this->nbRuta = $nbRuta;

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

    public function getFkOficina(): ?Oficina
    {
        return $this->fkOficina;
    }

    public function setFkOficina(?Oficina $fkOficina): self
    {
        $this->fkOficina = $fkOficina;

        return $this;
    }


}
