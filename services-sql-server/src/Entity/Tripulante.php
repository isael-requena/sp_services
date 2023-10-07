<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tripulante
 *
 * @ORM\Table(name="TRIPULANTE", indexes={@ORM\Index(name="IDX_5A5B8914514E6FFF", columns={"FK_LISTA_RECORRIDO"}), @ORM\Index(name="IDX_5A5B89145323F4DE", columns={"FK_PERSONA"}), @ORM\Index(name="IDX_5A5B8914B33D9AD1", columns={"FK_ROL"})})
 * @ORM\Entity
 */
class Tripulante
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_TRIPULANTE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTripulante;

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

    /**
     * @var \ListaRecorrido
     *
     * @ORM\ManyToOne(targetEntity="ListaRecorrido")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_LISTA_RECORRIDO", referencedColumnName="ID_LISTA_RECORRIDO")
     * })
     */
    private $fkListaRecorrido;

    /**
     * @var \Persona
     *
     * @ORM\ManyToOne(targetEntity="Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_PERSONA", referencedColumnName="ID_PERSONA")
     * })
     */
    private $fkPersona;

    /**
     * @var \Rol
     *
     * @ORM\ManyToOne(targetEntity="Rol")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_ROL", referencedColumnName="ID_ROL")
     * })
     */
    private $fkRol;

    public function getIdTripulante(): ?int
    {
        return $this->idTripulante;
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

    public function getFkListaRecorrido(): ?ListaRecorrido
    {
        return $this->fkListaRecorrido;
    }

    public function setFkListaRecorrido(?ListaRecorrido $fkListaRecorrido): self
    {
        $this->fkListaRecorrido = $fkListaRecorrido;

        return $this;
    }

    public function getFkPersona(): ?Persona
    {
        return $this->fkPersona;
    }

    public function setFkPersona(?Persona $fkPersona): self
    {
        $this->fkPersona = $fkPersona;

        return $this;
    }

    public function getFkRol(): ?string
    {
        return $this->fkRol->getDescripcion();
    }

    public function setFkRol(?Rol $fkRol): self
    {
        $this->fkRol = $fkRol;

        return $this;
    }


}
