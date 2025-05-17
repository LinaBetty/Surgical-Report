<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Personal
 *
 * @ORM\Table(name="personal", indexes={@ORM\Index(name="IDX_F18A6D847F4026EF", columns={"tipo_personal_fk"}), @ORM\Index(name="IDX_F18A6D847F6ACA99", columns={"nivel_profesional_fk"})})
 * @ORM\Entity
 */
class Personal
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="registro_profesional", type="string", length=15, nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $registroProfesional;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=true)
     */
    private $activo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_personal", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="personal_id_personal_seq", allocationSize=1, initialValue=1)
     */
    private $idPersonal;

    /**
     * @var \AppBundle\Entity\NivelProfesional
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\NivelProfesional")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nivel_profesional_fk", referencedColumnName="nivel_profesional_id")
     * })
     */
    private $nivelProfesionalFk;

    /**
     * @var \AppBundle\Entity\TipoPersonal
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TipoPersonal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_personal_fk", referencedColumnName="id_tipo_personal")
     * })
     */
    private $tipoPersonalFk;



    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Personal
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
     * Set registroProfesional
     *
     * @param string $registroProfesional
     *
     * @return Personal
     */
    public function setRegistroProfesional($registroProfesional)
    {
        $this->registroProfesional = $registroProfesional;

        return $this;
    }

    /**
     * Get registroProfesional
     *
     * @return string
     */
    public function getRegistroProfesional()
    {
        return $this->registroProfesional;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return Personal
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Get idPersonal
     *
     * @return integer
     */
    public function getIdPersonal()
    {
        return $this->idPersonal;
    }

    /**
     * Set nivelProfesionalFk
     *
     * @param \AppBundle\Entity\NivelProfesional $nivelProfesionalFk
     *
     * @return Personal
     */
    public function setNivelProfesionalFk(\AppBundle\Entity\NivelProfesional $nivelProfesionalFk = null)
    {
        $this->nivelProfesionalFk = $nivelProfesionalFk;

        return $this;
    }

    /**
     * Get nivelProfesionalFk
     *
     * @return \AppBundle\Entity\NivelProfesional
     */
    public function getNivelProfesionalFk()
    {
        return $this->nivelProfesionalFk;
    }

    /**
     * Set tipoPersonalFk
     *
     * @param \AppBundle\Entity\TipoPersonal $tipoPersonalFk
     *
     * @return Personal
     */
    public function setTipoPersonalFk(\AppBundle\Entity\TipoPersonal $tipoPersonalFk = null)
    {
        $this->tipoPersonalFk = $tipoPersonalFk;

        return $this;
    }

    /**
     * Get tipoPersonalFk
     *
     * @return \AppBundle\Entity\TipoPersonal
     */
    public function getTipoPersonalFk()
    {
        return $this->tipoPersonalFk;
    }
}
