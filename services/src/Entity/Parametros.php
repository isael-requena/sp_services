<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parametros
 *
 * @ORM\Table(name="parametros")
 * @ORM\Entity
 */
class Parametros
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_PARAMETRO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idParametro;

    /**
     * @var string|null
     *
     * @ORM\Column(name="EXCESO_LIMITE", type="decimal", precision=18, scale=2, nullable=true, options={"default"="NULL"})
     */
    private $excesoLimite = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="EXCESO_LIMITE_ALERTA", type="decimal", precision=18, scale=2, nullable=true, options={"default"="NULL"})
     */
    private $excesoLimiteAlerta = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="REFRESCAMIENTO", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $refrescamiento = NULL;

    /**
     * @var int|null
     *
     * @ORM\Column(name="REFRESCAMIENTO_MOVIL", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $refrescamientoMovil = NULL;

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

    public function getIdParametro(): ?int
    {
        return $this->idParametro;
    }

    public function getExcesoLimite(): ?string
    {
        return $this->excesoLimite;
    }

    public function setExcesoLimite(?string $excesoLimite): self
    {
        $this->excesoLimite = $excesoLimite;

        return $this;
    }

    public function getExcesoLimiteAlerta(): ?string
    {
        return $this->excesoLimiteAlerta;
    }

    public function setExcesoLimiteAlerta(?string $excesoLimiteAlerta): self
    {
        $this->excesoLimiteAlerta = $excesoLimiteAlerta;

        return $this;
    }

    public function getRefrescamiento(): ?int
    {
        return $this->refrescamiento;
    }

    public function setRefrescamiento(?int $refrescamiento): self
    {
        $this->refrescamiento = $refrescamiento;

        return $this;
    }

    public function getRefrescamientoMovil(): ?int
    {
        return $this->refrescamientoMovil;
    }

    public function setRefrescamientoMovil(?int $refrescamientoMovil): self
    {
        $this->refrescamientoMovil = $refrescamientoMovil;

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
