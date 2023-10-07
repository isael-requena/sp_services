<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * ComprobanteServicio
 *
 * @ORM\Table(name="comprobante_servicio", indexes={@ORM\Index(name="FK_COMPROBANTE_SERVICIO_TIPO_VALOR", columns={"FK_TIPO_VALOR"}), @ORM\Index(name="FK_COMPROBANTE_SERVICIO_TIPO_MONEDA", columns={"FK_TIPO_MONEDA"})})
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
     * @ORM\Column(name="CORRELATIVO", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $correlativo = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="COD_CLIENTE", type="string", length=10, nullable=true, options={"default"="NULL"})
     */
    private $codCliente = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="COD_CS", type="string", length=15, nullable=true, options={"default"="NULL"})
     */
    private $codCs = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="CANT_ENVASES", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $cantEnvases = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DICE_CONTENER", type="decimal", precision=18, scale=2, nullable=true, options={"default"="NULL"})
     */
    private $diceContener = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="COD_ORIGEN", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $codOrigen = NULL;

    /**
     * @var int|null
     *
     * @ORM\Column(name="COD_DESTINO", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $codDestino = NULL;

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

    public function getCodCliente(): ?string
    {
        return $this->codCliente;
    }

    public function setCodCliente(?string $codCliente): self
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

    /*public function getFecEstatus(): ?\DateTimeInterface
    {
        return $this->fecEstatus;
    }*/

    public function setFecEstatus(?\DateTimeInterface $fecEstatus): self
    {
        $this->fecEstatus = $fecEstatus;

        return $this;
    }

   /* public function getFecCreacion(): ?\DateTimeInterface
    {
        return $this->fecCreacion;
    }*/

    public function setFecCreacion(?\DateTimeInterface $fecCreacion): self
    {
        $this->fecCreacion = $fecCreacion;

        return $this;
    }

    /*public function getFecModificacion(): ?\DateTimeInterface
    {
        return $this->fecModificacion;
    }*/

    public function setFecModificacion(?\DateTimeInterface $fecModificacion): self
    {
        $this->fecModificacion = $fecModificacion;

        return $this;
    }


    public function getFkTipoMoneda(): ?string
    {
        return $this->fkTipoMoneda->getNbTipoMoneda();
    }

    public function setFkTipoMoneda(?TipoMoneda $fkTipoMoneda): self
    {
        $this->fkTipoMoneda = $fkTipoMoneda;

        return $this;
    }

    public function getFkTipoValor(): ?string
    {
        return $this->fkTipoValor->getnbTipoValor();
    }

    public function setFkTipoValor(?TipoValor $fkTipoValor): self
    {
        $this->fkTipoValor = $fkTipoValor;

        return $this;
    }


}
