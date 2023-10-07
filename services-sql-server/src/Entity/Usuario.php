<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Usuario
 *
 * @ORM\Table(name="USUARIO")
 * @ORM\Entity
 */
class Usuario implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NB_USUARIO", type="string", length=20, nullable=true)
     */
    private $username = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="NUM_EMPLEADO", type="string", length=10, nullable=true)
     */
    private $numEmpleado;

    /**
     * @var string|null
     *
     * @ORM\Column(name="REF_CLIENTE", type="string", length=10, nullable=true)
     */
    private $refCliente;

    /**
     * @var array|null
     *
     * @ORM\Column(name="ROLES", type="json", nullable=true, options={"default"="NULL"})
     */
    private $roles;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CLAVE", type="string", length=255, nullable=true)
     */
    private $clave;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ESTATUS_REGISTRO", type="integer", nullable=true, options={"default"="1"})
     */
    private $estatus = 1;

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
     * @var int|null
     *
     * @ORM\Column(name="CONECTADO", type="integer", nullable=true)
     */
    private $conectado;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getNumEmpleado(): ?string
    {
        return $this->numEmpleado;
    }

    public function setNumEmpleado(?string $numEmpleado): self
    {
        $this->numEmpleado = $numEmpleado;

        return $this;
    }

    public function getRefCliente(): ?string
    {
        return $this->refCliente;
    }

    public function setRefCliente(?string $refCliente): self
    {
        $this->refCliente = $refCliente;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(?array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->clave;
    }

    public function setPassword(string $clave): self
    {
        $this->clave = $clave;

        return $this;
    }

    public function isEstatus(): ?int
    {
        return $this->estatus;
    }

    public function setEstatus(?int $estatus): self
    {
        $this->estatus = $estatus;

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

    public function getConectado(): ?int
    {
        return $this->conectado;
    }

    public function setConectado(?int $conectado): self
    {
        $this->conectado = $conectado;

        return $this;
    }

    public function getSalt(){
        return null;
    }

    public function eraseCredentials(){

    }


}
