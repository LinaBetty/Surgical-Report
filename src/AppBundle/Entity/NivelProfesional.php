<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NivelProfesional
 *
 * @ORM\Table(name="nivel_profesional")
 * @ORM\Entity
 */
class NivelProfesional
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_corto", type="string", length=50, nullable=true)
     */
    private $nombreCorto;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_completo", type="string", length=1024, nullable=true)
     */
    private $nombreCompleto;

    /**
     * @var integer
     *
     * @ORM\Column(name="nivel_profesional_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="nivel_profesional_nivel_profesional_id_seq", allocationSize=1, initialValue=1)
     */
    private $nivelProfesionalId;



    /**
     * Set nombreCorto
     *
     * @param string $nombreCorto
     *
     * @return NivelProfesional
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
     * Set nombreCompleto
     *
     * @param string $nombreCompleto
     *
     * @return NivelProfesional
     */
    public function setNombreCompleto($nombreCompleto)
    {
        $this->nombreCompleto = $nombreCompleto;

        return $this;
    }

    /**
     * Get nombreCompleto
     *
     * @return string
     */
    public function getNombreCompleto()
    {
        return $this->nombreCompleto;
    }

    /**
     * Get nivelProfesionalId
     *
     * @return integer
     */
    public function getNivelProfesionalId()
    {
        return $this->nivelProfesionalId;
    }
}
