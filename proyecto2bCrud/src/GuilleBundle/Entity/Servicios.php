<?php

namespace GuilleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Servicios
 *
 * @ORM\Table(name="servicios")
 * @ORM\Entity(repositoryClass="GuilleBundle\Repository\ServiciosRepository")
 */
class Servicios
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=255)
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="titulacion", type="string", length=500)
     */
    private $titulacion;

    /**
     * @var string
     *
     * @ORM\Column(name="servicio", type="string", length=255)
     */
    private $servicio;

    /**
     * @var int
     *
     * @ORM\Column(name="precio", type="integer")
     */
    private $precio;

    /**
     * Many Servicios have Many Usuarios.
     * @ORM\ManyToMany(targetEntity="Usuarios", inversedBy="servicios")
     * @ORM\JoinTable(name="servicios_usuarios")
     */
    private $usuarios;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Servicios
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Servicios
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set titulacion
     *
     * @param string $titulacion
     *
     * @return Servicios
     */
    public function setTitulacion($titulacion)
    {
        $this->titulacion = $titulacion;

        return $this;
    }

    /**
     * Get titulacion
     *
     * @return string
     */
    public function getTitulacion()
    {
        return $this->titulacion;
    }

    /**
     * Set servicio
     *
     * @param string $servicio
     *
     * @return Servicios
     */
    public function setServicio($servicio)
    {
        $this->servicio = $servicio;

        return $this;
    }

    /**
     * Get servicio
     *
     * @return string
     */
    public function getServicio()
    {
        return $this->servicio;
    }

    /**
     * Set precio
     *
     * @param integer $precio
     *
     * @return Servicios
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return int
     */
    public function getPrecio()
    {
        return $this->precio;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usuarios = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add usuario
     *
     * @param \GuilleBundle\Entity\Usuarios $usuario
     *
     * @return Servicios
     */
    public function addUsuario(\GuilleBundle\Entity\Usuarios $usuario)
    {
        $this->usuarios[] = $usuario;

        return $this;
    }

    /**
     * Remove usuario
     *
     * @param \GuilleBundle\Entity\Usuarios $usuario
     */
    public function removeUsuario(\GuilleBundle\Entity\Usuarios $usuario)
    {
        $this->usuarios->removeElement($usuario);
    }

    /**
     * Get usuarios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }
    
        public function __toString()
    {
        return $this->nombre;
    }
}
