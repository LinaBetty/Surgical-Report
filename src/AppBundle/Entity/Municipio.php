<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Municipio
 *
 * @ORM\Table(name="municipio", indexes={@ORM\Index(name="IDX_FE98F5E0595620F1", columns={"provincia_fk"})})
 * @ORM\Entity
 */
class Municipio
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=1024, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_provincia", type="string", length=1024, nullable=true)
     */
    private $nombreProvincia;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="municipio_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Provincia
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Provincia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="provincia_fk", referencedColumnName="id")
     * })
     */
    private $provinciaFk;



    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Municipio
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
     * Set nombreProvincia
     *
     * @param string $nombreProvincia
     *
     * @return Municipio
     */
    public function setNombreProvincia($nombreProvincia)
    {
        $this->nombreProvincia = $nombreProvincia;

        return $this;
    }

    /**
     * Get nombreProvincia
     *
     * @return string
     */
    public function getNombreProvincia()
    {
        return $this->nombreProvincia;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set provinciaFk
     *
     * @param \AppBundle\Entity\Provincia $provinciaFk
     *
     * @return Municipio
     */
    public function setProvinciaFk(\AppBundle\Entity\Provincia $provinciaFk = null)
    {
        $this->provinciaFk = $provinciaFk;

        return $this;
    }

    /**
     * Get provinciaFk
     *
     * @return \AppBundle\Entity\Provincia
     */
    public function getProvinciaFk()
    {
        return $this->provinciaFk;
    }
}
