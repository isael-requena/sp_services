<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Punto
 *
 * @ORM\Table(name="punto", indexes={@ORM\Index(name="FK_PUNTO_MUNICIPIO", columns={"FK_MUNICIPIO"}), @ORM\Index(name="FK_PUNTO_CLIENTE", columns={"FK_CLIENTE"})})
 * @ORM\Entity
 */
class Punto
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_PUNTO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPunto;

    /**
     * @var int|null
     *
     * @ORM\Column(name="COD_PUNTO", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $codPunto = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NOMBRE_PUNTO", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $nombrePunto = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="VIA", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $via = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="CENTRO_POB", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $centroPob = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="EDIFICACION", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $edificacion = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="OFICINA", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $oficina = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="PISO", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $piso = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="REFERENCIA", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $referencia = 'NULL';

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
     * @var \Cliente
     *
     * @ORM\ManyToOne(targetEntity="Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_CLIENTE", referencedColumnName="ID_CLIENTE")
     * })
     */
    private $fkCliente;

    /**
     * @var \Municipio
     *
     * @ORM\ManyToOne(targetEntity="Municipio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_MUNICIPIO", referencedColumnName="ID_MUNICIPIO")
     * })
     */
    private $fkMunicipio;

    public function getIdPunto(): ?int
    {
        return $this->idPunto;
    }

    public function getCodPunto(): ?int
    {
        return $this->codPunto;
    }

    public function setCodPunto(?int $codPunto): self
    {
        $this->codPunto = $codPunto;

        return $this;
    }

    public function getNombrePunto(): ?string
    {
        return $this->nombrePunto;
    }

    public function setNombrePunto(?string $nombrePunto): self
    {
        $this->nombrePunto = $nombrePunto;

        return $this;
    }

    public function getVia(): ?string
    {
        return $this->via;
    }

    public function setVia(?string $via): self
    {
        $this->via = $via;

        return $this;
    }

    public function getCentroPob(): ?string
    {
        return $this->centroPob;
    }

    public function setCentroPob(?string $centroPob): self
    {
        $this->centroPob = $centroPob;

        return $this;
    }

    public function getEdificacion(): ?string
    {
        return $this->edificacion;
    }

    public function setEdificacion(?string $edificacion): self
    {
        $this->edificacion = $edificacion;

        return $this;
    }

    public function getOficina(): ?string
    {
        return $this->oficina;
    }

    public function setOficina(?string $oficina): self
    {
        $this->oficina = $oficina;

        return $this;
    }

    public function getPiso(): ?string
    {
        return $this->piso;
    }

    public function setPiso(?string $piso): self
    {
        $this->piso = $piso;

        return $this;
    }

    public function getReferencia(): ?string
    {
        return $this->referencia;
    }

    public function setReferencia(?string $referencia): self
    {
        $this->referencia = $referencia;

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

    public function getFkCliente(): ?Cliente
    {
        return $this->fkCliente;
    }

    public function setFkCliente(?Cliente $fkCliente): self
    {
        $this->fkCliente = $fkCliente;

        return $this;
    }

    public function getFkMunicipio(): ?Municipio
    {
        return $this->fkMunicipio;
    }

    public function setFkMunicipio(?Municipio $fkMunicipio): self
    {
        $this->fkMunicipio = $fkMunicipio;

        return $this;
    }


}
