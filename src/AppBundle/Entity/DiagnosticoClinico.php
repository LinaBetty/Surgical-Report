<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DiagnosticoClinico
 *
 * @ORM\Table(name="diagnostico_clinico")
 * @ORM\Entity
 */
class DiagnosticoClinico
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
     * @ORM\Column(name="id_diagnostico_clinico", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="diagnostico_clinico_id_diagnostico_clinico_seq", allocationSize=1, initialValue=1)
     */
    private $idDiagnosticoClinico;



    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return DiagnosticoClinico
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
     * Get idDiagnosticoClinico
     *
     * @return integer
     */
    public function getIdDiagnosticoClinico()
    {
        return $this->idDiagnosticoClinico;
    }
}
