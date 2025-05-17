<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoProtesis
 *
 * @ORM\Table(name="tipo_protesis")
 * @ORM\Entity
 */
class TipoProtesis
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
     * @ORM\Column(name="id_tipo_protesis", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="tipo_protesis_id_tipo_protesis_seq", allocationSize=1, initialValue=1)
     */
    private $idTipoProtesis;



    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return TipoProtesis
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
     * Get idTipoProtesis
     *
     * @return integer
     */
    public function getIdTipoProtesis()
    {
        return $this->idTipoProtesis;
    }
}
