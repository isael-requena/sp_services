<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * ListaRecorrido
 *
 * @ORM\Table(name="LISTA_RECORRIDO", indexes={@ORM\Index(name="IDX_FB08B10063D49B15", columns={"FK_TRANSPORTE"}), @ORM\Index(name="IDX_FB08B1008CE63AC6", columns={"FK_ESTATUS"}), @ORM\Index(name="IDX_FB08B100B114FFAC", columns={"FK_RUTA"})})
 * @ORM\Entity
 */
class ListaRecorrido
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_LISTA_RECORRIDO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idListaRecorrido;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NRO_LISTA", type="integer", nullable=true)
     */
    private $nroLista;

    /**
     * @var string|null
     *
     * @ORM\Column(name="SESION", type="string", length=2, nullable=true)
     */
    private $sesion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="LLAVEROS", type="integer", nullable=true)
     */
    private $llaveros;

    /**
     * @var int|null
     *
     * @ORM\Column(name="LLAVES", type="integer", nullable=true)
     */
    private $llaves;

    /**
     * @var int|null
     *
     * @ORM\Column(name="KILOMETRAJE_SALIDA", type="integer", nullable=true)
     */
    private $kilometrajeSalida;

    /**
     * @var int|null
     *
     * @ORM\Column(name="KILOMETRAJE_LLEGADA", type="integer", nullable=true)
     */
    private $kilometrajeLlegada;

    /**
     * @var string|null
     *
     * @ORM\Column(name="HORA_SALIDA", type="string", nullable=true)
     */
    private $horaSalida;

    /**
     * @var string|null
     *
     * @ORM\Column(name="HORA_LLEGADA", type="string", nullable=true)
     */
    private $horaLlegada;

    /**
     * @var string|null
     *
     * @ORM\Column(name="FEC_ESTATUS", type="string", nullable=true)
     */
    private $fecEstatus;

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
     * @var int|null
     *
     * @ORM\Column(name="ESTATUS_REGISTRO", type="integer", nullable=true, options={"default"="1"})
     */
    private $estatusRegistro = 1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="FEC_CREACION", type="string", nullable=true)
     */
    private $fecCreacion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="FEC_MODIFICACION", type="string", nullable=true)
     */
    private $fecModificacion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="FEC_LISTA", type="string", nullable=true)
     */
    private $fecLista;

    /**
     * @var \Transporte
     *
     * @ORM\ManyToOne(targetEntity="Transporte")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_TRANSPORTE", referencedColumnName="ID_TRANSPORTE")
     * })
     */
    private $fkTransporte;

    /**
     * @var \Estatus
     *
     * @ORM\ManyToOne(targetEntity="Estatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_ESTATUS", referencedColumnName="ID_ESTATUS")
     * })
     */
    private $fkEstatus;

    /**
     * @var \Ruta
     *
     * @ORM\ManyToOne(targetEntity="Ruta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_RUTA", referencedColumnName="ID_RUTA")
     * })
     */
    private $fkRuta;

    /**
     * @var \PuntoLr
     *
     * @ORM\OneToMany(targetEntity="PuntoLr", mappedBy="fkListaRecorrido")
     */
    private $puntos;

    public function __construct()
    {
        $this->puntos = new ArrayCollection();
    }

    /**
     * @return Collection|PuntoLr[]
     */
    public function getPuntos(): Collection
    {
        return $this->puntos;
    }

    
    public function getId(): ?int
    {
        return $this->idListaRecorrido;
    }

    public function getNroLista(): ?int
    {
        return $this->nroLista;
    }

    public function setNroLista(?int $nroLista): self
    {
        $this->nroLista = $nroLista;

        return $this;
    }

    public function getSesion(): ?string
    {
        return $this->sesion;
    }

    public function setSesion(?string $sesion): self
    {
        $this->sesion = $sesion;

        return $this;
    }

    public function getLlaveros(): ?int
    {
        return $this->llaveros;
    }

    public function setLlaveros(?int $llaveros): self
    {
        $this->llaveros = $llaveros;

        return $this;
    }

    public function getLlaves(): ?int
    {
        return $this->llaves;
    }

    public function setLlaves(?int $llaves): self
    {
        $this->llaves = $llaves;

        return $this;
    }

    public function getKilometrajeSalida(): ?int
    {
        return $this->kilometrajeSalida;
    }

    public function setKilometrajeSalida(?int $kilometrajeSalida): self
    {
        $this->kilometrajeSalida = $kilometrajeSalida;

        return $this;
    }

    public function getKilometrajeLlegada(): ?int
    {
        return $this->kilometrajeLlegada;
    }

    public function setKilometrajeLlegada(?int $kilometrajeLlegada): self
    {
        $this->kilometrajeLlegada = $kilometrajeLlegada;

        return $this;
    }

    public function getHoraSalida(): ?string
    {
        return $this->horaSalida;
    }

    public function setHoraSalida(?string $horaSalida): self
    {
        $this->horaSalida = $horaSalida;

        return $this;
    }

    public function getHoraLlegada(): ?string
    {
        return $this->horaLlegada;
    }

    public function setHoraLlegada(?string $horaLlegada): self
    {
        $this->horaLlegada = $horaLlegada;

        return $this;
    }

    public function getFecEstatus(): ?string
    {
        return $this->fecEstatus;
    }

    public function setFecEstatus(?string $fecEstatus): self
    {
        $this->fecEstatus = $fecEstatus;

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

    public function getEstatusRegistro(): ?int
    {
        return $this->estatusRegistro;
    }

    public function setEstatusRegistro(?int $estatusRegistro): self
    {
        $this->estatusRegistro = $estatusRegistro;

        return $this;
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

    public function getFecModificacion(): ?string
    {
        return $this->fecModificacion;
    }

    public function setFecModificacion(?string $fecModificacion): self
    {
        $this->fecModificacion = $fecModificacion;

        return $this;
    }

    public function getFecLista(): ?string
    {
        return $this->fecLista;
    }

    public function setFecLista(?string $fecLista): self
    {
        $this->fecLista = $fecLista;

        return $this;
    }

    public function getFkTransporte(): ?Transporte
    {
        return $this->fkTransporte;
    }

    public function setFkTransporte(?Transporte $fkTransporte): self
    {
        $this->fkTransporte = $fkTransporte;

        return $this;
    }

    public function getFkEstatus(): ?Estatus
    {
        return $this->fkEstatus;
    }

    public function setFkEstatus(?Estatus $fkEstatus): self
    {
        $this->fkEstatus = $fkEstatus;

        return $this;
    }

    public function getFkRuta(): ?Ruta
    {
        return $this->fkRuta;
    }

    public function setFkRuta(?Ruta $fkRuta): self
    {
        $this->fkRuta = $fkRuta;

        return $this;
    }


}
