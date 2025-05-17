<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Traza
 *
 * @ORM\Table(name="traza", indexes={@ORM\Index(name="IDX_AD36B8A0CC1F42C0", columns={"usuario_fk"}), @ORM\Index(name="IDX_AD36B8A0F1F2969D", columns={"operacion_fk"})})
 * @ORM\Entity
 */
class Traza
{
    /**
     * @var string
     *
     * @ORM\Column(name="accion_realizada", type="text", nullable=true)
     */
    private $accionRealizada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora", type="time", nullable=true)
     */
    private $hora;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_traza", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="traza_id_traza_seq", allocationSize=1, initialValue=1)
     */
    private $idTraza;

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
     * @var \AppBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_fk", referencedColumnName="id")
     * })
     */
    private $usuarioFk;



    /**
     * Set accionRealizada
     *
     * @param string $accionRealizada
     *
     * @return Traza
     */
    public function setAccionRealizada($accionRealizada)
    {
        $this->accionRealizada = $accionRealizada;

        return $this;
    }

    /**
     * Get accionRealizada
     *
     * @return string
     */
    public function getAccionRealizada()
    {
        return $this->accionRealizada;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Traza
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set hora
     *
     * @param \DateTime $hora
     *
     * @return Traza
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get hora
     *
     * @return \DateTime
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Get idTraza
     *
     * @return integer
     */
    public function getIdTraza()
    {
        return $this->idTraza;
    }

    /**
     * Set operacionFk
     *
     * @param \AppBundle\Entity\Operacion $operacionFk
     *
     * @return Traza
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
     * Set usuarioFk
     *
     * @param \AppBundle\Entity\Usuario $usuarioFk
     *
     * @return Traza
     */
    public function setUsuarioFk(\AppBundle\Entity\Usuario $usuarioFk = null)
    {
        $this->usuarioFk = $usuarioFk;

        return $this;
    }

    /**
     * Get usuarioFk
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUsuarioFk()
    {
        return $this->usuarioFk;
    }
}
