<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OperacionRealizada
 *
 * @ORM\Table(name="operacion_realizada")
 * @ORM\Entity
 */
class OperacionRealizada
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=1024, nullable=true)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_operacion_realizada", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="operacion_realizada_id_operacion_realizada_seq", allocationSize=1, initialValue=1)
     */
    private $idOperacionRealizada;



    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return OperacionRealizada
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
     * Get idOperacionRealizada
     *
     * @return integer
     */
    public function getIdOperacionRealizada()
    {
        return $this->idOperacionRealizada;
    }
}
