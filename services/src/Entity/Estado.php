<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estado
 *
 * @ORM\Table(name="estado", indexes={@ORM\Index(name="FK_ESTADO_PAIS", columns={"FK_PAIS"})})
 * @ORM\Entity
 */
class Estado
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_ESTADO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEstado;

    /**
     * @var int|null
     *
     * @ORM\Column(name="COD_ESTADO", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $codEstado = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NB_ESTADO", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $nbEstado = 'NULL';

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
     * @var int|null
     *
     * @ORM\Column(name="ESTATUS_REGISTRO", type="integer", nullable=true, options={"default"="1"})
     */
    private $estatusRegistro = 1;

    /**
     * @var \Pais
     *
     * @ORM\ManyToOne(targetEntity="Pais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_PAIS", referencedColumnName="ID_PAIS")
     * })
     */
    private $fkPais;

    public function getIdEstado(): ?int
    {
        return $this->idEstado;
    }

    public function getCodEstado(): ?int
    {
        return $this->codEstado;
    }

    public function setCodEstado(?int $codEstado): self
    {
        $this->codEstado = $codEstado;

        return $this;
    }

    public function getNbEstado(): ?string
    {
        return $this->nbEstado;
    }

    public function setNbEstado(?string $nbEstado): self
    {
        $this->nbEstado = $nbEstado;

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

    public function getFkPais(): ?Pais
    {
        return $this->fkPais;
    }

    public function setFkPais(?Pais $fkPais): self
    {
        $this->fkPais = $fkPais;

        return $this;
    }


}
