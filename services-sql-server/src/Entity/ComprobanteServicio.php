<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * ComprobanteServicio
 *
 * @ORM\Table(name="COMPROBANTE_SERVICIO", indexes={@ORM\Index(name="IDX_25BE582470E0E958", columns={"FK_TIPO_MONEDA"}), @ORM\Index(name="IDX_25BE58247F27FF77", columns={"FK_TIPO_VALOR"})})
 * @ORM\Entity
 */
class ComprobanteServicio
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_COMPROBANTE_SERVICIO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idComprobanteServicio;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CORRELATIVO", type="integer", nullable=true)
     */
    private $correlativo;

    /**
     * @var int|null
     *
     * @ORM\Column(name="COD_CLIENTE", type="integer", nullable=true)
     */
    private $codCliente;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DIGITAL", type="string", length=1, nullable=true)
     */
    private $digital;

    /**
     * @var string|null
     *
     * @ORM\Column(name="COD_CS", type="string", length=15, nullable=true)
     */
    private $codCs;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CANT_ENVASES", type="integer", nullable=true)
     */
    private $cantEnvases;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DICE_CONTENER", type="decimal", precision=18, scale=2, nullable=true)
     */
    private $diceContener;

    /**
     * @var int|null
     *
     * @ORM\Column(name="COD_ORIGEN", type="integer", nullable=true)
     */
    private $codOrigen;

    /**
     * @var int|null
     *
     * @ORM\Column(name="COD_DESTINO", type="integer", nullable=true)
     */
    private $codDestino;

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
     * @ORM\Column(name="FEC_ESTATUS", type="string", nullable=true)
     */
    private $fecEstatus;

    /**
     * @var string|null
     *
     * @ORM\Column(name="FEC_CREACION", type="string", nullable=true)
     */
    private $fecCreacion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="FEC_COMPROBANTE", type="string", nullable=true)
     */
    private $fecComprobante;

    /**
     * @var string|null
     *
     * @ORM\Column(name="FEC_MODIFICACION", type="string", nullable=true)
     */
    private $fecModificacion;

    /**
     * @var \TipoMoneda
     *
     * @ORM\ManyToOne(targetEntity="TipoMoneda")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_TIPO_MONEDA", referencedColumnName="ID_TIPO_MONEDA")
     * })
     */
    private $fkTipoMoneda;

    /**
     * @var \TipoValor
     *
     * @ORM\ManyToOne(targetEntity="TipoValor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_TIPO_VALOR", referencedColumnName="ID_TIPO_VALOR")
     * })
     */
    private $fkTipoValor;

    /**
     * @var \Envase
     *
     * @ORM\OneToMany(targetEntity="Envase", mappedBy="fkComprobanteServicio")
     */
    private $envases;

    public function __construct()
    {
        $this->envases = new ArrayCollection();
    }

    /**
     * @return Collection|Envase[]
     */
    public function getEnvases(): Collection
    {
        return $this->envases;
    }

    public function getId(): ?int
    {
        return $this->idComprobanteServicio;
    }

    public function getCorrelativo(): ?int
    {
        return $this->correlativo;
    }

    public function setCorrelativo(?int $correlativo): self
    {
        $this->correlativo = $correlativo;

        return $this;
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

    public function getCodCs(): ?string
    {
        return $this->codCs;
    }

    public function setCodCs(?string $codCs): self
    {
        $this->codCs = $codCs;

        return $this;
    }

    public function getCantEnvases(): ?int
    {
        return $this->cantEnvases;
    }

    public function setCantEnvases(?int $cantEnvases): self
    {
        $this->cantEnvases = $cantEnvases;

        return $this;
    }

    public function getDiceContener(): ?string
    {
        return $this->diceContener;
    }

    public function setDiceContener(?string $diceContener): self
    {
        $this->diceContener = $diceContener;

        return $this;
    }

    public function getCodOrigen(): ?int
    {
        return $this->codOrigen;
    }

    public function setCodOrigen(?int $codOrigen): self
    {
        $this->codOrigen = $codOrigen;

        return $this;
    }

    public function getCodDestino(): ?int
    {
        return $this->codDestino;
    }

    public function setCodDestino(?int $codDestino): self
    {
        $this->codDestino = $codDestino;

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

    /*public function getFecEstatus(): ?string
    {
        return $this->fecEstatus;
    }*/

    public function setFecEstatus(?string $fecEstatus): self
    {
        $this->fecEstatus = $fecEstatus;

        return $this;
    }

    /*public function getFecCreacion(): ?string
    {
        return $this->fecCreacion;
    }*/

    public function setFecCreacion(?string $fecCreacion): self
    {
        $this->fecCreacion = $fecCreacion;

        return $this;
    }

    /*public function getFecComprobante(): ?string
    {
        return $this->fecComprobante;
    }*/

    public function setFecComprobante(?string $fecComprobante): self
    {
        $this->fecComprobante = $fecComprobante;

        return $this;
    }

    /*public function getFecModificacion(): ?string
    {
        return $this->fecModificacion;
    }*/

    public function setFecModificacion(?string $fecModificacion): self
    {
        $this->fecModificacion = $fecModificacion;

        return $this;
    }

    public function getFkTipoMoneda(): ?string
    {
        if ($this->fkTipoMoneda == null) {
            return $this->fkTipoMoneda;
        }else{
            return $this->fkTipoMoneda->getNbTipoMoneda();
        }
        
    }

    public function setFkTipoMoneda(?TipoMoneda $fkTipoMoneda): self
    {
        $this->fkTipoMoneda = $fkTipoMoneda;

        return $this;
    }

    public function getFkTipoValor(): ?string
    {
        if ($this->fkTipoValor == null) {
            return $this->fkTipoValor;
        }else{
            return $this->fkTipoValor->getnbTipoValor();
        }
        
    }

    public function setFkTipoValor(?TipoValor $fkTipoValor): self
    {
        $this->fkTipoValor = $fkTipoValor;

        return $this;
    }

    public function getDigital(): ?string
    {
        return $this->digital;
    }

    public function setDigital(?string $digital): self
    {
        $this->digital = $digital;

        return $this;
    }


}
