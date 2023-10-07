<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Region
 *
 * @ORM\Table(name="region")
 * @ORM\Entity
 */
class Region
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_REGION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRegion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="COD_REGION", type="string", length=5, nullable=true, options={"default"="NULL"})
     */
    private $codRegion = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="NB_REGION", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $nbRegion = 'NULL';

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

    public function getIdRegion(): ?int
    {
        return $this->idRegion;
    }

    public function getCodRegion(): ?string
    {
        return $this->codRegion;
    }

    public function setCodRegion(?string $codRegion): self
    {
        $this->codRegion = $codRegion;

        return $this;
    }

    public function getNbRegion(): ?string
    {
        return $this->nbRegion;
    }

    public function setNbRegion(?string $nbRegion): self
    {
        $this->nbRegion = $nbRegion;

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
