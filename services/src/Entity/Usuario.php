<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity
 */
class Usuario implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NB_USUARIO", type="string", length=20, nullable=true, options={"default"="NULL"})
     */
    private $username = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="NUM_EMPLEADO", type="string", length=10, nullable=true, options={"default"="NULL"})
     */
    private $numEmpleado = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="REF_CLIENTE", type="string", length=10, nullable=true, options={"default"="NULL"})
     */
    private $refCliente = 'NULL';

    /**
     * @var array|null
     *
     * @ORM\Column(name="ROLES", type="json", nullable=true, options={"default"="NULL"})
     */
    private $roles;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CLAVE", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $clave = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="ESTATUS_REGISTRO", type="bigint", nullable=true, options={"default"="NULL"})
     */
    private $estatus = 'NULL';

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
     * @var int|null
     *
     * @ORM\Column(name="CONECTADO", type="bigint", nullable=true, options={"default"="NULL"})
     */
    private $conectado = 'NULL';

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

    public function getSalt(){
        return null;
    }

    public function eraseCredentials(){

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

    public function getConectado(): ?int
    {
        return $this->conectado;
    }

    public function setConectado(?int $conectado): self
    {
        $this->conectado = $conectado;

        return $this;
    }

}
