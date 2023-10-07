<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * ListaRecorrido
 *
 * @ORM\Table(name="lista_recorrido", indexes={@ORM\Index(name="FK_LISTA_RECORRIDO_TRANSPORTE", columns={"FK_TRANSPORTE"}), @ORM\Index(name="FK_LISTA_RECORRIDO_ESTATUS", columns={"FK_ESTATUS"}), @ORM\Index(name="FK_LISTA_RECORRIDO_RUTA", columns={"FK_RUTA"})})
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
     * @ORM\Column(name="NRO_LISTA", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $nroLista = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="SESION", type="string", length=2, nullable=true, options={"default"="NULL"})
     */
    private $sesion = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="LLAVEROS", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $llaveros = NULL;

    /**
     * @var int|null
     *
     * @ORM\Column(name="LLAVES", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $llaves = NULL;

    /**
     * @var int|null
     *
     * @ORM\Column(name="KILOMETRAJE_SALIDA", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $kilometrajeSalida = NULL;

    /**
     * @var int|null
     *
     * @ORM\Column(name="KILOMETRAJE_LLEGADA", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $kilometrajeLlegada = NULL;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="HORA_SALIDA", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $horaSalida = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="HORA_LLEGADA", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $horaLlegada = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FEC_ESTATUS", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $fecEstatus = 'NULL';

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
     * @var \DateTime|null
     *
     * @ORM\Column(name="FEC_LISTA", type="date", nullable=true, options={"default"="NULL"})
     */
    private $fecLista = 'NULL';

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

    public function getHoraSalida(): ?\DateTimeInterface
    {
        return $this->horaSalida;
    }

    public function setHoraSalida(?\DateTimeInterface $horaSalida): self
    {
        $this->horaSalida = $horaSalida;

        return $this;
    }

    public function getHoraLlegada(): ?\DateTimeInterface
    {
        return $this->horaLlegada;
    }

    public function setHoraLlegada(?\DateTimeInterface $horaLlegada): self
    {
        $this->horaLlegada = $horaLlegada;

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

    public function getFecLista(): ?\DateTimeInterface
    {
        return $this->fecLista;
    }

    public function setFecLista(?\DateTimeInterface $fecLista): self
    {
        $this->fecLista = $fecLista;

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


}
