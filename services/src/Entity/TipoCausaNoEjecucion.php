<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoCausaNoEjecucion
 *
 * @ORM\Table(name="tipo_causa_no_ejecucion")
 * @ORM\Entity
 */
class TipoCausaNoEjecucion
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_TIPO_CAUSA_NO_EJECUCION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTipoCausaNoEjecucion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DESCRIPCION", type="string", length=20, nullable=true, options={"default"="NULL"})
     */
    private $descripcion = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FEC_ESTATUS", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $fecEstatus = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="COD_CARNET", type="string", length=10, nullable=true, options={"default"="NULL"})
     */
    private $codCarnet = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="NB_CREADOR", type="string", length=20, nullable=true, options={"default"="NULL"})
     */
    private $nbCreador = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="NB_MODIFICADOR", type="string", length=20, nullable=true, options={"default"="NULL"})
     */
    private $nbModificador = 'NULL';

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
     * @ORM\Column(name="ESTATUS", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $estatus = NULL;

    public function getIdTipoCausaNoEjecucion(): ?int
    {
        return $this->idTipoCausaNoEjecucion;
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

    public function getFecEstatus(): ?\DateTimeInterface
    {
        return $this->fecEstatus;
    }

    public function setFecEstatus(?\DateTimeInterface $fecEstatus): self
    {
        $this->fecEstatus = $fecEstatus;

        return $this;
    }

    public function getCodCarnet(): ?string
    {
        return $this->codCarnet;
    }

    public function setCodCarnet(?string $codCarnet): self
    {
        $this->codCarnet = $codCarnet;

        return $this;
    }

    public function getNbCreador(): ?string
    {
        return $this->nbCreador;
    }

    public function setNbCreador(?string $nbCreador): self
    {
        $this->nbCreador = $nbCreador;

        return $this;
    }

    public function getNbModificador(): ?string
    {
        return $this->nbModificador;
    }

    public function setNbModificador(?string $nbModificador): self
    {
        $this->nbModificador = $nbModificador;

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

    public function getEstatus(): ?int
    {
        return $this->estatus;
    }

    public function setEstatus(?int $estatus): self
    {
        $this->estatus = $estatus;

        return $this;
    }


}
