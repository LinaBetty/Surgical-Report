<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reflejos
 *
 * @ORM\Table(name="reflejos")
 * @ORM\Entity
 */
class Reflejos
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
     * @ORM\Column(name="id_reflejos", type="string", length=1)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="reflejos_id_reflejos_seq", allocationSize=1, initialValue=1)
     */
    private $idReflejos;



    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Reflejos
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
     * Get idReflejos
     *
     * @return string
     */
    public function getIdReflejos()
    {
        return $this->idReflejos;
    }
}
