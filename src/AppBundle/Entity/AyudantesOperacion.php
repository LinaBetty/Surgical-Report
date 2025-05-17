<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AyudantesOperacion
 *
 * @ORM\Table(name="ayudantes_operacion", indexes={@ORM\Index(name="IDX_41C1C12B4A640817", columns={"personal_fk"}), @ORM\Index(name="IDX_41C1C12BF1F2969D", columns={"operacion_fk"})})
 * @ORM\Entity
 */
class AyudantesOperacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_ayudantes_operacion", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ayudantes_operacion_id_ayudantes_operacion_seq", allocationSize=1, initialValue=1)
     */
    private $idAyudantesOperacion;

    /**
     * @var \AppBundle\Entity\Operacion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Operacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="operacion_fk", referencedColumnName="id_operacion")
     * })
     */
    private $operacionFk;

    /**
     * @var \AppBundle\Entity\Personal
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Personal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="personal_fk", referencedColumnName="id_personal")
     * })
     */
    private $personalFk;



    /**
     * Get idAyudantesOperacion
     *
     * @return integer
     */
    public function getIdAyudantesOperacion()
    {
        return $this->idAyudantesOperacion;
    }

    /**
     * Set operacionFk
     *
     * @param \AppBundle\Entity\Operacion $operacionFk
     *
     * @return AyudantesOperacion
     */
    public function setOperacionFk(\AppBundle\Entity\Operacion $operacionFk = null)
    {
        $this->operacionFk = $operacionFk;

        return $this;
    }

    /**
     * Get operacionFk
     *
     * @return \AppBundle\Entity\Operacion
     */
    public function getOperacionFk()
    {
        return $this->operacionFk;
    }

    /**
     * Set personalFk
     *
     * @param \AppBundle\Entity\Personal $personalFk
     *
     * @return AyudantesOperacion
     */
    public function setPersonalFk(\AppBundle\Entity\Personal $personalFk = null)
    {
        $this->personalFk = $personalFk;

        return $this;
    }

    /**
     * Get personalFk
     *
     * @return \AppBundle\Entity\Personal
     */
    public function getPersonalFk()
    {
        return $this->personalFk;
    }
}
