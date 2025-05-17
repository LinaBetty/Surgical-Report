<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Raza
 *
 * @ORM\Table(name="raza")
 * @ORM\Entity
 */
class Raza
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
     * @ORM\Column(name="id_raza", type="string", length=1)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="raza_id_raza_seq", allocationSize=1, initialValue=1)
     */
    private $idRaza;



    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Raza
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
     * Get idRaza
     *
     * @return string
     */
    public function getIdRaza()
    {
        return $this->idRaza;
    }
}
