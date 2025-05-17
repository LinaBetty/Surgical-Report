<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoPersonal
 *
 * @ORM\Table(name="tipo_personal")
 * @ORM\Entity
 */
class TipoPersonal
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
     * @ORM\Column(name="id_tipo_personal", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="tipo_personal_id_tipo_personal_seq", allocationSize=1, initialValue=1)
     */
    private $idTipoPersonal;



    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return TipoPersonal
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
     * Get idTipoPersonal
     *
     * @return integer
     */
    public function getIdTipoPersonal()
    {
        return $this->idTipoPersonal;
    }
}
