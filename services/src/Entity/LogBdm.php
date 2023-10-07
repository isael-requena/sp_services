<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogBdm
 *
 * @ORM\Table(name="log_bdm")
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
     * @ORM\Column(name="USUARIO_CREACION", type="string", length=20, nullable=true, options={"default"="NULL"})
     */
    private $usuarioCreacion = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FECHA_CREACION", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $fecha = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="ESTATUS_REGISTRO", type="integer", nullable=true, options={"default"="1"})
     */
    private $estatusRegistro = 1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DESCRIPCION", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $descripcion = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="FK_LISTA_RECORRIDO", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $listaRecorrido = NULL;
    

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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

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

    public function getEstatusRegistro(): ?int
    {
        return $this->estatusRegistro;
    }

    public function setEstatusRegistro(?int $estatusRegistro): self
    {
        $this->estatusRegistro = $estatusRegistro;

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


}
