<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Persona
 *
 * @ORM\Table(name="PERSONA")
 * @ORM\Entity
 */
class Persona
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_PERSONA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPersona;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CEDULA", type="string", length=20, nullable=true)
     */
    private $cedula;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CARGO", type="string", length=50, nullable=true)
     */
    private $cargo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PRIMER_APELLIDO", type="string", length=20, nullable=true)
     */
    private $primerApellido;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PRIMER_NOMBRE", type="string", length=20, nullable=true)
     */
    private $primerNombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="SEGUNDO_APELLIDO", type="string", length=20, nullable=true)
     */
    private $segundoApellido;

    /**
     * @var string|null
     *
     * @ORM\Column(name="SEGUNDO_NOMBRE", type="string", length=20, nullable=true)
     */
    private $segundoNombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NUM_EMPLEADO", type="string", length=10, nullable=true)
     */
    private $numEmpleado;

    /**
     * @var string|null
     *
     * @ORM\Column(name="USUARIO_CREACION", type="string", length=20, nullable=true)
     */
    private $usuarioCreacion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="USUARIO_MODIFICACION", type="string", length=20, nullable=true)
     */
    private $usuarioModificacion;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FEC_ESTATUS", type="datetime", nullable=true)
     */
    private $fecEstatus;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FEC_CREACION", type="datetime", nullable=true)
     */
    private $fecCreacion;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FEC_MODIFICACION", type="datetime", nullable=true)
     */
    private $fecModificacion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ESTATUS_REGISTRO", type="integer", nullable=true, options={"default"="1"})
     */
    private $estatusRegistro = 1;

    public function getIdPersona(): ?int
    {
        return $this->idPersona;
    }

    public function getCedula(): ?string
    {
        return $this->cedula;
    }

    public function setCedula(?string $cedula): self
    {
        $this->cedula = $cedula;

        return $this;
    }

    public function getCargo(): ?string
    {
        return $this->cargo;
    }

    public function setCargo(?string $cargo): self
    {
        $this->cargo = $cargo;

        return $this;
    }

    public function getPrimerApellido(): ?string
    {
        return $this->primerApellido;
    }

    public function setPrimerApellido(?string $primerApellido): self
    {
        $this->primerApellido = $primerApellido;

        return $this;
    }

    public function getPrimerNombre(): ?string
    {
        return $this->primerNombre;
    }

    public function setPrimerNombre(?string $primerNombre): self
    {
        $this->primerNombre = $primerNombre;

        return $this;
    }

    public function getSegundoApellido(): ?string
    {
        return $this->segundoApellido;
    }

    public function setSegundoApellido(?string $segundoApellido): self
    {
        $this->segundoApellido = $segundoApellido;

        return $this;
    }

    public function getSegundoNombre(): ?string
    {
        return $this->segundoNombre;
    }

    public function setSegundoNombre(?string $segundoNombre): self
    {
        $this->segundoNombre = $segundoNombre;

        return $this;
    }

    public function getNumEmpleado(): ?string
    {
        return $this->numEmpleado;
    }

    public function setNumEmpleado(?string $numEmpleado): self
    {
        $this->numEmpleado = $numEmpleado;

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
