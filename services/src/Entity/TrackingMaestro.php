<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TrackingMaestro
 *
 * @ORM\Table(name="tracking_maestro", indexes={@ORM\Index(name="FK_TRACKING_MAESTRO_ESTATUS_MAESTROS", columns={"FK_ESTATUS_MAESTROS"})})
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
     * @ORM\Column(name="COD_CLIENTE", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $codCliente = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="COMPROBANTE", type="string", length=15, nullable=true, options={"default"="NULL"})
     */
    private $comprobante = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="NUM_CORREL", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $numCorrel = NULL;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ENVASES", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $envases = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="MONTO_DECLARADO", type="decimal", precision=18, scale=2, nullable=true, options={"default"="NULL"})
     */
    private $montoDeclarado = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="PUNTO_ORIGEN", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $puntoOrigen = NULL;

    /**
     * @var int|null
     *
     * @ORM\Column(name="PUNTO_DESTINO", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $puntoDestino = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ORIGEN", type="string", length=10, nullable=true, options={"default"="NULL"})
     */
    private $origen = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="NUM_VALOR", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $numValor = NULL;

    /**
     * @var int|null
     *
     * @ORM\Column(name="MONEDA", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $moneda = NULL;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FECHA_TRANSACCION", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $fechaTransaccion = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FECHA_COMP", type="date", nullable=true, options={"default"="NULL"})
     */
    private $fechaComp = 'NULL';

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
     * @var \EstatusMaestros
     *
     * @ORM\ManyToOne(targetEntity="EstatusMaestros")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_ESTATUS_MAESTROS", referencedColumnName="ID_ESTATUS_MAESTROS")
     * })
     */
    private $fkEstatusMaestros;

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


}
