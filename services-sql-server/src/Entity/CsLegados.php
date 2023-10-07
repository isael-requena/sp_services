<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CsLegados
 *
 * @ORM\Table(name="CS_LEGADOS")
 * @ORM\Entity
 */
class CsLegados
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_CS_LEGADOS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCsLegados;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CLIENTE", type="integer", nullable=true)
     */
    private $cliente;

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
     * @var string|null
     *
     * @ORM\Column(name="ORIGEN", type="string", length=10, nullable=true)
     */
    private $origen;

    /**
     * @var int|null
     *
     * @ORM\Column(name="VALOR", type="integer", nullable=true)
     */
    private $valor;

    /**
     * @var int|null
     *
     * @ORM\Column(name="MONEDA", type="integer", nullable=true)
     */
    private $moneda;

    /**
     * @var string|null
     *
     * @ORM\Column(name="STATUS", type="string", length=25, nullable=true)
     */
    private $status;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ID_CS", type="integer", nullable=true)
     */
    private $idCs;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TIPO_DENOM", type="string", length=10, nullable=true)
     */
    private $tipoDenom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="COD_CIA", type="string", length=10, nullable=true)
     */
    private $codCia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="COD_OFI", type="string", length=10, nullable=true)
     */
    private $codOfi;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FECHA_OPER", type="date", nullable=true)
     */
    private $fechaOper;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NUM_S47", type="integer", nullable=true)
     */
    private $numS47;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NUM_ORD_VIEJ", type="string", length=15, nullable=true)
     */
    private $numOrdViej;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NUM_CTA", type="string", length=15, nullable=true)
     */
    private $numCta;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="FECHA_AUTOR", type="date", nullable=true)
     */
    private $fechaAutor;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NUM_AUTORIZ", type="integer", nullable=true)
     */
    private $numAutoriz;

    /**
     * @var string|null
     *
     * @ORM\Column(name="COD_AGENCIA", type="string", length=10, nullable=true)
     */
    private $codAgencia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TIPO_MOV", type="string", length=3, nullable=true)
     */
    private $tipoMov;

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
     * @var int|null
     *
     * @ORM\Column(name="FK_ESTATUS_MAESTROS", type="integer", nullable=true)
     */
    private $fkEstatusMaestros;

    public function getIdCsLegados(): ?int
    {
        return $this->idCsLegados;
    }

    public function getCliente(): ?int
    {
        return $this->cliente;
    }

    public function setCliente(?int $cliente): self
    {
        $this->cliente = $cliente;

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

    public function getOrigen(): ?string
    {
        return $this->origen;
    }

    public function setOrigen(?string $origen): self
    {
        $this->origen = $origen;

        return $this;
    }

    public function getValor(): ?int
    {
        return $this->valor;
    }

    public function setValor(?int $valor): self
    {
        $this->valor = $valor;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getIdCs(): ?int
    {
        return $this->idCs;
    }

    public function setIdCs(?int $idCs): self
    {
        $this->idCs = $idCs;

        return $this;
    }

    public function getTipoDenom(): ?string
    {
        return $this->tipoDenom;
    }

    public function setTipoDenom(?string $tipoDenom): self
    {
        $this->tipoDenom = $tipoDenom;

        return $this;
    }

    public function getCodCia(): ?string
    {
        return $this->codCia;
    }

    public function setCodCia(?string $codCia): self
    {
        $this->codCia = $codCia;

        return $this;
    }

    public function getCodOfi(): ?string
    {
        return $this->codOfi;
    }

    public function setCodOfi(?string $codOfi): self
    {
        $this->codOfi = $codOfi;

        return $this;
    }

    public function getFechaOper(): ?\DateTimeInterface
    {
        return $this->fechaOper;
    }

    public function setFechaOper(?\DateTimeInterface $fechaOper): self
    {
        $this->fechaOper = $fechaOper;

        return $this;
    }

    public function getNumS47(): ?int
    {
        return $this->numS47;
    }

    public function setNumS47(?int $numS47): self
    {
        $this->numS47 = $numS47;

        return $this;
    }

    public function getNumOrdViej(): ?string
    {
        return $this->numOrdViej;
    }

    public function setNumOrdViej(?string $numOrdViej): self
    {
        $this->numOrdViej = $numOrdViej;

        return $this;
    }

    public function getNumCta(): ?string
    {
        return $this->numCta;
    }

    public function setNumCta(?string $numCta): self
    {
        $this->numCta = $numCta;

        return $this;
    }

    public function getFechaAutor(): ?\DateTimeInterface
    {
        return $this->fechaAutor;
    }

    public function setFechaAutor(?\DateTimeInterface $fechaAutor): self
    {
        $this->fechaAutor = $fechaAutor;

        return $this;
    }

    public function getNumAutoriz(): ?int
    {
        return $this->numAutoriz;
    }

    public function setNumAutoriz(?int $numAutoriz): self
    {
        $this->numAutoriz = $numAutoriz;

        return $this;
    }

    public function getCodAgencia(): ?string
    {
        return $this->codAgencia;
    }

    public function setCodAgencia(?string $codAgencia): self
    {
        $this->codAgencia = $codAgencia;

        return $this;
    }

    public function getTipoMov(): ?string
    {
        return $this->tipoMov;
    }

    public function setTipoMov(?string $tipoMov): self
    {
        $this->tipoMov = $tipoMov;

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

    public function getFkEstatusMaestros(): ?int
    {
        return $this->fkEstatusMaestros;
    }

    public function setFkEstatusMaestros(?int $fkEstatusMaestros): self
    {
        $this->fkEstatusMaestros = $fkEstatusMaestros;

        return $this;
    }


}
