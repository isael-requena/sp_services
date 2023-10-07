<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogBdm
 *
 * @ORM\Table(name="LOG_BDM")
 * @ORM\Entity
 */
class LogBdm
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_LOG", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLog;

    /**
     * @var string|null
     *
     * @ORM\Column(name="USUARIO_CREACION", type="string", length=255, nullable=true)
     */
    private $usuarioCreacion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="FECHA_CREACION", type="string", nullable=true)
     */
    private $fechaCreacion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ESTATUS_REGISTRO", type="integer", nullable=true, options={"default"="1"})
     */
    private $estatusRegistro = 1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DESCRIPCION", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="FK_LISTA_RECORRIDO", type="integer", nullable=true)
     */
    private $fkListaRecorrido;

    public function getIdLog(): ?int
    {
        return $this->idLog;
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

    public function getFecha(): ?string
    {
        return $this->fechaCreacion;
    }

    public function setFecha(?string $fechaCreacion): self
    {
        $this->fechaCreacion = $fechaCreacion;

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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getFkListaRecorrido(): ?int
    {
        return $this->fkListaRecorrido;
    }

    public function setListaRecorrido(?int $fkListaRecorrido): self
    {
        $this->fkListaRecorrido = $fkListaRecorrido;

        return $this;
    }


}
