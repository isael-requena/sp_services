<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogRm
 *
 * @ORM\Table(name="log_rm", indexes={@ORM\Index(name="FK_LOG_RM_LOG_TIPO", columns={"FK_LOG_TIPO"})})
 * @ORM\Entity
 */
class LogRm
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_LOG_RM", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLogRm;

    /**
     * @var string|null
     *
     * @ORM\Column(name="USUARIO_CREACION", type="string", length=20, nullable=true, options={"default"="NULL"})
     */
    private $usuarioCreacion = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FECHA", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $fecha = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="ENTIDAD", type="string", length=50, nullable=true, options={"default"="NULL"})
     */
    private $entidad = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="ID_REGISTRO", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $idRegistro = NULL;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ESTATUS_REGISTRO", type="integer", nullable=true, options={"default"="1"})
     */
    private $estatusRegistro = 1;

    /**
     * @var \LogTipo
     *
     * @ORM\ManyToOne(targetEntity="LogTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_LOG_TIPO", referencedColumnName="ID_LOG_TIPO")
     * })
     */
    private $fkLogTipo;

    public function getIdLogRm(): ?int
    {
        return $this->idLogRm;
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

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(?\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getEntidad(): ?string
    {
        return $this->entidad;
    }

    public function setEntidad(?string $entidad): self
    {
        $this->entidad = $entidad;

        return $this;
    }

    public function getIdRegistro(): ?int
    {
        return $this->idRegistro;
    }

    public function setIdRegistro(?int $idRegistro): self
    {
        $this->idRegistro = $idRegistro;

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

    public function getFkLogTipo(): ?LogTipo
    {
        return $this->fkLogTipo;
    }

    public function setFkLogTipo(?LogTipo $fkLogTipo): self
    {
        $this->fkLogTipo = $fkLogTipo;

        return $this;
    }


}
