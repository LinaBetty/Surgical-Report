<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Respiracion
 *
 * @ORM\Table(name="respiracion")
 * @ORM\Entity
 */
class Respiracion
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="id_respiracion", type="string", length=1)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="respiracion_id_respiracion_seq", allocationSize=1, initialValue=1)
     */
    private $idRespiracion;



    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Respiracion
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
     * Get idRespiracion
     *
     * @return string
     */
    public function getIdRespiracion()
    {
        return $this->idRespiracion;
    }
}
