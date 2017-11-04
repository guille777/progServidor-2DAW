<?php

namespace cervezaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * cervecitas
 *
 * @ORM\Table(name="cervecitas")
 * @ORM\Entity(repositoryClass="cervezaBundle\Repository\cervecitasRepository")
 */
class cervecitas
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
     * @ORM\Column(name="pais", type="string", length=255)
     */
    private $pais;

    /**
     * @var string
     *
     * @ORM\Column(name="poblacion", type="string", length=255)
     */
    private $poblacion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255)
     */
    private $tipo;

    /**
     * @var bool
     *
     * @ORM\Column(name="importacion", type="boolean")
     */
    private $importacion;

    /**
     * @var int
     *
     * @ORM\Column(name="tamano", type="integer")
     */
    private $tamano;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlamcen", type="date")
     */
    private $fechaAlamcen;

    /**
     * @var int
     *
     * @ORM\Column(name="cantidad", type="integer")
     */
    private $cantidad;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=255)
     */
    private $foto;


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
     * @return cervecitas
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
     * Set pais
     *
     * @param string $pais
     *
     * @return cervecitas
     */
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return string
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set poblacion
     *
     * @param string $poblacion
     *
     * @return cervecitas
     */
    public function setPoblacion($poblacion)
    {
        $this->poblacion = $poblacion;

        return $this;
    }

    /**
     * Get poblacion
     *
     * @return string
     */
    public function getPoblacion()
    {
        return $this->poblacion;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return cervecitas
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set importacion
     *
     * @param boolean $importacion
     *
     * @return cervecitas
     */
    public function setImportacion($importacion)
    {
        $this->importacion = $importacion;

        return $this;
    }

    /**
     * Get importacion
     *
     * @return bool
     */
    public function getImportacion()
    {
        return $this->importacion;
    }

    /**
     * Set tamano
     *
     * @param integer $tamano
     *
     * @return cervecitas
     */
    public function setTamano($tamano)
    {
        $this->tamano = $tamano;

        return $this;
    }

    /**
     * Get tamano
     *
     * @return int
     */
    public function getTamano()
    {
        return $this->tamano;
    }

    /**
     * Set fechaAlamcen
     *
     * @param \DateTime $fechaAlamcen
     *
     * @return cervecitas
     */
    public function setFechaAlamcen($fechaAlamcen)
    {
        $this->fechaAlamcen = $fechaAlamcen;

        return $this;
    }

    /**
     * Get fechaAlamcen
     *
     * @return \DateTime
     */
    public function getFechaAlamcen()
    {
        return $this->fechaAlamcen;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return cervecitas
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return int
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set foto
     *
     * @param string $foto
     *
     * @return cervecitas
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }
}

