<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EstadoSalirSalon
 *
 * @ORM\Table(name="estado_salir_salon")
 * @ORM\Entity
 */
class EstadoSalirSalon
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
     * @ORM\Column(name="id_estado_salir_salon", type="string", length=1)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="estado_salir_salon_id_estado_salir_salon_seq", allocationSize=1, initialValue=1)
     */
    private $idEstadoSalirSalon;



    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return EstadoSalirSalon
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
     * Get idEstadoSalirSalon
     *
     * @return string
     */
    public function getIdEstadoSalirSalon()
    {
        return $this->idEstadoSalirSalon;
    }
}
