<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogPanico
 *
 * @ORM\Table(name="LOG_PANICO")
 * @ORM\Entity
 */
class LogPanico
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_LOG_PANICO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLogPanico;

    /**
     * @var string|null
     *
     * @ORM\Column(name="FEC_CREACION", type="string", nullable=true)
     */
    private $fecCreacion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="LISTA_RECORRIDO", type="integer", nullable=true)
     */
    private $listaRecorrido;

    /**
     * @var int|null
     *
     * @ORM\Column(name="FK_PUNTOLR", type="integer", nullable=true)
     */
    private $fkPuntolr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="FEC_PUNTO", type="string", nullable=true)
     */
    private $fecPunto;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ESTATUS_PUNTO", type="integer", nullable=true)
     */
    private $estatusPunto;

    /**
     * @var string|null
     *
     * @ORM\Column(name="USUARIO_CREACION", type="string", length=20, nullable=true)
     */
    private $usuarioCreacion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ESTATUS_REGISTRO", type="integer", nullable=true, options={"default"="1"})
     */
    private $estatusRegistro = 1;

    public function getIdLogPanico(): ?int
    {
        return $this->idLogPanico;
    }

    public function getFecCreacion(): ?string
    {
        return $this->fecCreacion;
    }

    public function setFecCreacion(?string $fecCreacion): self
    {
        $this->fecCreacion = $fecCreacion;

        return $this;
    }

    public function getListaRecorrido(): ?int
    {
        return $this->listaRecorrido;
    }

    public function setListaRecorrido(?int $listaRecorrido): self
    {
        $this->listaRecorrido = $listaRecorrido;

        return $this;
    }

    public function getFkPuntolr(): ?int
    {
        return $this->fkPuntolr;
    }

    public function setFkPuntolr(?int $fkPuntolr): self
    {
        $this->fkPuntolr = $fkPuntolr;

        return $this;
    }

    public function getFecPunto(): ?string
    {
        return $this->fecPunto;
    }

    public function setFecPunto(?string $fecPunto): self
    {
        $this->fecPunto = $fecPunto;

        return $this;
    }

    public function getEstatusPunto(): ?int
    {
        return $this->estatusPunto;
    }

    public function setEstatusPunto(?int $estatusPunto): self
    {
        $this->estatusPunto = $estatusPunto;

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
