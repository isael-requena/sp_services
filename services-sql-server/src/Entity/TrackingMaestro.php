<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TrackingMaestro
 *
 * @ORM\Table(name="TRACKING_MAESTRO")
 * @ORM\Entity
 */
class TrackingMaestro
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_TRACKING_MAESTRO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTrackingMaestro;

    /**
     * @var int|null
     *
     * @ORM\Column(name="COD_CLIENTE", type="integer", nullable=true)
     */
    private $codCliente;

    /**
     * @var string|null
     *
     * @ORM\Column(name="COMPROBANTE", type="string", length=15, nullable=true)
     */
    private $comprobante;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NUM_CORREL", type="integer", nullable=true)
     */
    private $numCorrel;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ENVASES", type="integer", nullable=true)
     */
    private $envases;

    /**
     * @var string|null
     *
     * @ORM\Column(name="MONTO_DECLARADO", type="decimal", precision=18, scale=2, nullable=true)
     */
    private $montoDeclarado;

    /**
     * @var int|null
     *
     * @ORM\Column(name="PUNTO_ORIGEN", type="integer", nullable=true)
     */
    private $puntoOrigen;

    /**
     * @var int|null
     *
     * @ORM\Column(name="PUNTO_DESTINO", type="integer", nullable=true)
     */
    private $puntoDestino;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ORIGEN", type="string", length=10, nullable=true)
     */
    private $origen;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NUM_VALOR", type="integer", nullable=true)
     */
    private $numValor;

    /**
     * @var int|null
     *
     * @ORM\Column(name="MONEDA", type="integer", nullable=true)
     */
    private $moneda;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DIRECCION_ORIGEN", type="text", length=16, nullable=true)
     */
    private $direccionOrigen;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DIRECCION_DESTINO", type="text", length=16, nullable=true)
     */
    private $direccionDestino;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FECHA_TRANSACCION", type="datetime", nullable=true)
     */
    private $fechaTransaccion;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FECHA_COMP", type="date", nullable=true)
     */
    private $fechaComp;

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
     * @var \EstatusMaestros
     *
     * @ORM\ManyToOne(targetEntity="EstatusMaestros")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_ESTATUS_MAESTROS", referencedColumnName="ID_ESTATUS_MAESTROS")
     * })
     */
    private $fkEstatusMaestros;

    private $descripcionPuntoOrigen;
    private $descripcionPuntoDestino;


    public function getIdTrackingMaestro(): ?int
    {
        return $this->idTrackingMaestro;
    }

    public function getCodCliente(): ?int
    {
        return $this->codCliente;
    }

    public function setCodCliente(?int $codCliente): self
    {
        $this->codCliente = $codCliente;

        return $this;
    }

    public function getComprobante(): ?string
    {
        return $this->comprobante;
    }

    public function setComprobante(?string $comprobante): self
    {
        $this->comprobante = $comprobante;

        return $this;
    }

    public function getNumCorrel(): ?int
    {
        return $this->numCorrel;
    }

    public function setNumCorrel(?int $numCorrel): self
    {
        $this->numCorrel = $numCorrel;

        return $this;
    }

    public function getEnvases(): ?int
    {
        return $this->envases;
    }

    public function setEnvases(?int $envases): self
    {
        $this->envases = $envases;

        return $this;
    }

    public function getMontoDeclarado(): ?string
    {
        return $this->montoDeclarado;
    }

    public function setMontoDeclarado(?string $montoDeclarado): self
    {
        $this->montoDeclarado = $montoDeclarado;

        return $this;
    }

    public function getPuntoOrigen(): ?int
    {
        return $this->puntoOrigen;
    }

    public function setPuntoOrigen(?int $puntoOrigen): self
    {
        $this->puntoOrigen = $puntoOrigen;

        return $this;
    }

    public function getPuntoDestino(): ?int
    {
        return $this->puntoDestino;
    }

    public function setPuntoDestino(?int $puntoDestino): self
    {
        $this->puntoDestino = $puntoDestino;

        return $this;
    }

    public function getOrigen(): ?string
    {
        return $this->origen;
    }

    public function setOrigen(?string $origen): self
    {
        $this->origen = $origen;

        return $this;
    }

    public function getNumValor(): ?int
    {
        return $this->numValor;
    }

    public function setNumValor(?int $numValor): self
    {
        $this->numValor = $numValor;

        return $this;
    }

    public function getMoneda(): ?int
    {
        return $this->moneda;
    }

    public function setMoneda(?int $moneda): self
    {
        $this->moneda = $moneda;

        return $this;
    }

    public function getDireccionOrigen(): ?string
    {
       // return $this->direccionOrigen;
       return $this->descripcionPuntoOrigen;
    }

    public function setDireccionOrigen(?string $direccionOrigen): self
    {
        $this->direccionOrigen = $direccionOrigen;

        return $this;
    }

    public function getDireccionDestino(): ?string
    {
        //return $this->direccionDestino;
        return $this->descripcionPuntoDestino;
    }

    public function setDireccionDestino(?string $direccionDestino): self
    {
        $this->direccionDestino = $direccionDestino;

        return $this;
    }

    public function getFechaTransaccion(): ?\DateTimeInterface
    {
        return $this->fechaTransaccion;
    }

    public function setFechaTransaccion(?\DateTimeInterface $fechaTransaccion): self
    {
        $this->fechaTransaccion = $fechaTransaccion;

        return $this;
    }

    public function getFechaComp(): ?\DateTimeInterface
    {
        return $this->fechaComp;
    }

    public function setFechaComp(?\DateTimeInterface $fechaComp): self
    {
        $this->fechaComp = $fechaComp;

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

    public function getCodEstatusMaestros(): ?string
    {   
        if ($this->fkEstatusMaestros == null) {
            return $this->fkEstatusMaestros;
        }else{
            return $this->fkEstatusMaestros->getCodEstatus();
        }
        
    }

    public function getDescripcionEstatusMaestros(): ?string
    {   
        if ($this->fkEstatusMaestros == null) {
            return $this->fkEstatusMaestros;
        }else{
            return $this->fkEstatusMaestros->getDescripcion();
        }
        
    }

    public function setFkEstatusMaestros(?EstatusMaestros $fkEstatusMaestros): self
    {
        $this->fkEstatusMaestros = $fkEstatusMaestros;

        return $this;
    }

    /*public function getDescripcionPuntoOrigen(): ?string
    {   
        return $this->descripcionPuntoOrigen;
    }*/

    public function setDescripcionPuntoOrigen(?string $descripcionPuntoOrigen): self
    {
        $this->descripcionPuntoOrigen = $descripcionPuntoOrigen;

        return $this;
    }

    /*public function getDescripcionPuntoDestino(): ?string
    {   
        return $this->descripcionPuntoDestino;
    }*/

    public function setDescripcionPuntoDestino(?string $descripcionPuntoDestino): self
    {
        $this->descripcionPuntoDestino = $descripcionPuntoDestino;

        return $this;
    }


}
