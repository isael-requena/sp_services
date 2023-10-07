<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ciudad
 *
 * @ORM\Table(name="ciudad", indexes={@ORM\Index(name="FK_CIUDAD_ESTADO", columns={"FK_ESTADO"})})
 * @ORM\Entity
 */
class Ciudad
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_CIUDAD", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCiudad;

    /**
     * @var int|null
     *
     * @ORM\Column(name="COD_CIUDAD", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $codCiudad = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NB_CIUDAD", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $nbCiudad = 'NULL';

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
     * @var \Estado
     *
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_ESTADO", referencedColumnName="ID_ESTADO")
     * })
     */
    private $fkEstado;

    public function getIdCiudad(): ?int
    {
        return $this->idCiudad;
    }

    public function getCodCiudad(): ?int
    {
        return $this->codCiudad;
    }

    public function setCodCiudad(?int $codCiudad): self
    {
        $this->codCiudad = $codCiudad;

        return $this;
    }

    public function getNbCiudad(): ?string
    {
        return $this->nbCiudad;
    }

    public function setNbCiudad(?string $nbCiudad): self
    {
        $this->nbCiudad = $nbCiudad;

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

    public function getFkEstado(): ?Estado
    {
        return $this->fkEstado;
    }

    public function setFkEstado(?Estado $fkEstado): self
    {
        $this->fkEstado = $fkEstado;

        return $this;
    }


}
