<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * PuntoLr
 *
 * @ORM\Table(name="punto_lr", indexes={@ORM\Index(name="FK_PUNTO_LR_PUNTO", columns={"FK_PUNTO"}), @ORM\Index(name="FK_PUNTO_LR_CAUSA_NO_EJECUCION", columns={"FK_CAUSA_NO_EJECUCION"}), @ORM\Index(name="FK_PUNTO_LR_LISTA_RECORRIDO", columns={"FK_LISTA_RECORRIDO"}), @ORM\Index(name="FK_PUNTO_LR_ESTATUS", columns={"FK_ESTATUS"})})
 * @ORM\Entity
 */
class PuntoLr
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_PUNTO_LR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPuntoLr;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NUM_LINEA", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $numLinea = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="OBSERVACIONES", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $observaciones = 'NULL';

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
     * @var \DateTime|null
     *
     * @ORM\Column(name="FEC_ESTATUS", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $fecEstatus = 'NULL';

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
     * @var int|null
     *
     * @ORM\Column(name="ESTATUS_REGISTRO", type="integer", nullable=true, options={"default"="1"})
     */
    private $estatusRegistro = 1;

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
     * @var \ListaRecorrido
     *
     * @ORM\ManyToOne(targetEntity="ListaRecorrido")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_LISTA_RECORRIDO", referencedColumnName="ID_LISTA_RECORRIDO")
     * })
     */
    private $fkListaRecorrido;

    /**
     * @var \CausaNoEjecucion
     *
     * @ORM\ManyToOne(targetEntity="CausaNoEjecucion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_CAUSA_NO_EJECUCION", referencedColumnName="ID_CAUSA_NO_EJECUCION")
     * })
     */
    private $fkCausaNoEjecucion;

    /**
     * @var \Punto
     *
     * @ORM\ManyToOne(targetEntity="Punto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_PUNTO", referencedColumnName="ID_PUNTO")
     * })
     */
    private $fkPunto;

    /**
     * @var \CsPuntoLr
     *
     * @ORM\OneToMany(targetEntity="CsPuntoLr", mappedBy="fkPuntolr")
     */
    private $receipts;

    public function __construct()
    {
        $this->receipts = new ArrayCollection();
    }

    /**
     * @return Collection|PuntoLr[]
     */
    public function getCs(): Collection
    {
        return $this->receipts;
    }

    public function getId(): ?int
    {
        return $this->idPuntoLr;
    }

    public function getNumLinea(): ?int
    {
        return $this->numLinea;
    }

    public function setNumLinea(?int $numLinea): self
    {
        $this->numLinea = $numLinea;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(?string $observaciones): self
    {
        $this->observaciones = $observaciones;

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

    public function getFkEstatus(): ?Estatus
    {
        return $this->fkEstatus;
    }

    public function setFkEstatus(?Estatus $fkEstatus): self
    {
        $this->fkEstatus = $fkEstatus;

        return $this;
    }

    public function getFkListaRecorrido(): ?int
    {
        return $this->fkListaRecorrido->getId();
    }

    public function setFkListaRecorrido(?ListaRecorrido $fkListaRecorrido): self
    {
        $this->fkListaRecorrido = $fkListaRecorrido;

        return $this;
    }

    public function getFkCausaNoEjecucion(): ?CausaNoEjecucion
    {
        return $this->fkCausaNoEjecucion;
    }

    public function setFkCausaNoEjecucion(?CausaNoEjecucion $fkCausaNoEjecucion): self
    {
        $this->fkCausaNoEjecucion = $fkCausaNoEjecucion;

        return $this;
    }

    public function getFkPunto(): ?Punto
    {
        return $this->fkPunto;
    }

    public function setFkPunto(?Punto $fkPunto): self
    {
        $this->fkPunto = $fkPunto;

        return $this;
    }


}
