<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClasifOperTipo2
 *
 * @ORM\Table(name="clasif_oper_tipo_2")
 * @ORM\Entity
 */
class ClasifOperTipo2
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
     * @ORM\Column(name="id_clasif_oper_tipo_2", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="clasif_oper_tipo_2_id_clasif_oper_tipo_2_seq", allocationSize=1, initialValue=1)
     */
    private $idClasifOperTipo2;



    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return ClasifOperTipo2
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
     * Get idClasifOperTipo2
     *
     * @return integer
     */
    public function getIdClasifOperTipo2()
    {
        return $this->idClasifOperTipo2;
    }
}
