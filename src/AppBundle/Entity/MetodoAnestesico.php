<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MetodoAnestesico
 *
 * @ORM\Table(name="metodo_anestesico")
 * @ORM\Entity
 */
class MetodoAnestesico
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
     * @ORM\Column(name="nombre_corto", type="string", length=50, nullable=true)
     */
    private $nombreCorto;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_metodo_anestesico", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="metodo_anestesico_id_metodo_anestesico_seq", allocationSize=1, initialValue=1)
     */
    private $idMetodoAnestesico;



    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return MetodoAnestesico
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
     * Set nombreCorto
     *
     * @param string $nombreCorto
     *
     * @return MetodoAnestesico
     */
    public function setNombreCorto($nombreCorto)
    {
        $this->nombreCorto = $nombreCorto;

        return $this;
    }

    /**
     * Get nombreCorto
     *
     * @return string
     */
    public function getNombreCorto()
    {
        return $this->nombreCorto;
    }

    /**
     * Get idMetodoAnestesico
     *
     * @return integer
     */
    public function getIdMetodoAnestesico()
    {
        return $this->idMetodoAnestesico;
    }
}
