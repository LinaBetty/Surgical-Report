<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClasifOperTipo3
 *
 * @ORM\Table(name="clasif_oper_tipo_3")
 * @ORM\Entity
 */
class ClasifOperTipo3
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
     * @ORM\Column(name="id_clasif_oper_tipo_3", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="clasif_oper_tipo_3_id_clasif_oper_tipo_3_seq", allocationSize=1, initialValue=1)
     */
    private $idClasifOperTipo3;



    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return ClasifOperTipo3
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
     * Get idClasifOperTipo3
     *
     * @return integer
     */
    public function getIdClasifOperTipo3()
    {
        return $this->idClasifOperTipo3;
    }
}
