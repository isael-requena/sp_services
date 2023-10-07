<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Membresia
 *
 * @ORM\Table(name="membresia", indexes={@ORM\Index(name="FK_MEMBRESIA_USUARIO", columns={"FK_USUARIO"}), @ORM\Index(name="FK_MEMBRESIA_ALCANCE", columns={"FK_ALCANCE"}), @ORM\Index(name="FK_MEMBRESIA_FUNCION", columns={"FK_FUNCION"})})
 * @ORM\Entity
 */
class Membresia
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_MEMBRESIA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMembresia;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ENTIDAD", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $entidad = NULL;

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
     * @var int|null
     *
     * @ORM\Column(name="ESTATUS_REGISTRO", type="integer", nullable=true, options={"default"="1"})
     */
    private $estatusRegistro = 1;

    /**
     * @var \Alcance
     *
     * @ORM\ManyToOne(targetEntity="Alcance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_ALCANCE", referencedColumnName="ID_ALCANCE")
     * })
     */
    private $fkAlcance;

    /**
     * @var \Funcion
     *
     * @ORM\ManyToOne(targetEntity="Funcion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_FUNCION", referencedColumnName="ID_FUNCION")
     * })
     */
    private $fkFuncion;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_USUARIO", referencedColumnName="ID")
     * })
     */
    private $fkUsuario;

    public function getIdMembresia(): ?int
    {
        return $this->idMembresia;
    }

   /* public function getEntidad(): ?int
    {
        return $this->entidad;
    }*/

    public function setEntidad(?int $entidad): self
    {
        $this->entidad = $entidad;

        return $this;
    }

    /*public function getFecCreacion(): ?\DateTimeInterface
    {
        return $this->fecCreacion;
    }*/

    public function setFecCreacion(?\DateTimeInterface $fecCreacion): self
    {
        $this->fecCreacion = $fecCreacion;

        return $this;
    }

   /* public function getFecModificacion(): ?\DateTimeInterface
    {
        return $this->fecModificacion;
    }*/

    public function setFecModificacion(?\DateTimeInterface $fecModificacion): self
    {
        $this->fecModificacion = $fecModificacion;

        return $this;
    }

    /*public function getUsuarioCreacion(): ?string
    {
        return $this->usuarioCreacion;
    }*/

    public function setUsuarioCreacion(?string $usuarioCreacion): self
    {
        $this->usuarioCreacion = $usuarioCreacion;

        return $this;
    }

    /*public function getUsuarioModificacion(): ?string
    {
        return $this->usuarioModificacion;
    }*/

    public function setUsuarioModificacion(?string $usuarioModificacion): self
    {
        $this->usuarioModificacion = $usuarioModificacion;

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

   /* public function getFkAlcance(): ?Alcance
    {
        return $this->fkAlcance;
    }*/

    public function setFkAlcance(?Alcance $fkAlcance): self
    {
        $this->fkAlcance = $fkAlcance;

        return $this;
    }

    public function getFkFuncion(): ?String
    {
        return $this->fkFuncion->getDescripcion();
    }

    public function setFkFuncion(?Funcion $fkFuncion): self
    {
        $this->fkFuncion = $fkFuncion;

        return $this;
    }

    /*public function getFkUsuario(): ?Usuario
    {
        return $this->fkUsuario;
    }*/

    public function setFkUsuario(?Usuario $fkUsuario): self
    {
        $this->fkUsuario = $fkUsuario;

        return $this;
    }


}
