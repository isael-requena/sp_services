<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CausaNoEjecucion
 *
 * @ORM\Table(name="causa_no_ejecucion", indexes={@ORM\Index(name="FK_CAUSA_NO_EJECUCION_TIPO_CAUSA", columns={"FK_TIPO_CAUSA"})})
 * @ORM\Entity
 */
class CausaNoEjecucion
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_CAUSA_NO_EJECUCION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCausaNoEjecucion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="COD_NO_EJECUCION", type="string", length=10, nullable=true, options={"default"="NULL"})
     */
    private $codNoEjecucion = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="DESCRIPCION", type="string", length=100, nullable=true, options={"default"="NULL"})
     */
    private $descripcion = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="IMPUTABLE", type="string", length=20, nullable=true, options={"default"="NULL"})
     */
    private $imputable = 'NULL';

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
     * @ORM\Column(name="FEC_ESTATUS", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $fecEstatus = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="ESTATUS_REGISTRO", type="integer", nullable=true, options={"default"="1"})
     */
    private $estatusRegistro = 1;

    /**
     * @var \TipoCausa
     *
     * @ORM\ManyToOne(targetEntity="TipoCausa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_TIPO_CAUSA", referencedColumnName="ID_TIPO_CAUSA")
     * })
     */
    private $fkTipoCausa;

    public function getIdCausaNoEjecucion(): ?int
    {
        return $this->idCausaNoEjecucion;
    }

    public function getCodNoEjecucion(): ?string
    {
        return $this->codNoEjecucion;
    }

    public function setCodNoEjecucion(?string $codNoEjecucion): self
    {
        $this->codNoEjecucion = $codNoEjecucion;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getImputable(): ?string
    {
        return $this->imputable;
    }

    public function setImputable(?string $imputable): self
    {
        $this->imputable = $imputable;

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

    public function getFecEstatus(): ?\DateTimeInterface
    {
        return $this->fecEstatus;
    }

    public function setFecEstatus(?\DateTimeInterface $fecEstatus): self
    {
        $this->fecEstatus = $fecEstatus;

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

    public function getFkTipoCausa(): ?TipoCausa
    {
        return $this->fkTipoCausa;
    }

    public function setFkTipoCausa(?TipoCausa $fkTipoCausa): self
    {
        $this->fkTipoCausa = $fkTipoCausa;

        return $this;
    }


}
