<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogPanico
 *
 * @ORM\Table(name="log_panico")
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
     * @var \DateTime|null
     *
     * @ORM\Column(name="FEC_CREACION", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $fecCreacion = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="LISTA_RECORRIDO", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $listaRecorrido = NULL;

    /**
     * @var int|null
     *
     * @ORM\Column(name="FK_PUNTOLR", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $fkPuntolr = NULL;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FEC_PUNTO", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $fecPunto = NULL;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ESTATUS_PUNTO", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $estatusPunto = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="USUARIO_CREACION", type="string", length=20, nullable=true, options={"default"="NULL"})
     */
    private $usuarioCreacion = 'NULL';

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

    public function getFecCreacion(): ?\DateTimeInterface
    {
        return $this->fecCreacion;
    }

    public function setFecCreacion(?\DateTimeInterface $fecCreacion): self
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

    public function getFecPunto(): ?\DateTimeInterface
    {
        return $this->fecPunto;
    }

    public function setFecPunto(?\DateTimeInterface $fecPunto): self
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
