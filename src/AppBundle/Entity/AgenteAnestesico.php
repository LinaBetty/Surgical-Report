<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AgenteAnestesico
 *
 * @ORM\Table(name="agente_anestesico")
 * @ORM\Entity
 */
class AgenteAnestesico
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=true)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_agente_anestesico", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="agente_anestesico_id_agente_anestesico_seq", allocationSize=1, initialValue=1)
     */
    private $idAgenteAnestesico;



    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return AgenteAnestesico
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
     * Get idAgenteAnestesico
     *
     * @return integer
     */
    public function getIdAgenteAnestesico()
    {
        return $this->idAgenteAnestesico;
    }
}
