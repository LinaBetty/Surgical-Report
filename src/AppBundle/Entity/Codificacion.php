<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Codificacion
 *
 * @ORM\Table(name="codificacion")
 * @ORM\Entity
 */
class Codificacion
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_codificacion", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="codificacion_id_codificacion_seq", allocationSize=1, initialValue=1)
     */
    private $idCodificacion;



    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Codificacion
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
     * Get idCodificacion
     *
     * @return integer
     */
    public function getIdCodificacion()
    {
        return $this->idCodificacion;
    }
}
