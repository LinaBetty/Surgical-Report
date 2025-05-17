<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClasifOperTipo1
 *
 * @ORM\Table(name="clasif_oper_tipo_1")
 * @ORM\Entity
 */
class ClasifOperTipo1
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
     * @ORM\Column(name="id_clasif_oper_tipo_1", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="clasif_oper_tipo_1_id_clasif_oper_tipo_1_seq", allocationSize=1, initialValue=1)
     */
    private $idClasifOperTipo1;



    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return ClasifOperTipo1
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
     * Get idClasifOperTipo1
     *
     * @return integer
     */
    public function getIdClasifOperTipo1()
    {
        return $this->idClasifOperTipo1;
    }
}
