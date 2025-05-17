<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Pacientes
 *
 * @ORM\Table(name="pacientes", indexes={@ORM\Index(name="IDX_971B785162106CCD", columns={"estado_civil_fk"}), @ORM\Index(name="IDX_971B78519BECB7F7", columns={"raza_fk"}), @ORM\Index(name="IDX_971B78513C15DA06", columns={"sexo_fk"}), @ORM\Index(name="IDX_971B7851595620F1", columns={"provincia_fk"}), @ORM\Index(name="IDX_971B78514F9B1ABE", columns={"municipio_fk"})})
 * @ORM\Entity
 */
class Pacientes
{
    /**
     * @var string
     *
     * @ORM\Column(name="historia_clinica", type="string", length=20, nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $historiaClinica;

    /**
     * @var string
     *
     * @ORM\Column(name="ci", type="string", length=11, nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $ci;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=30, nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="primer_apellido", type="string", length=30, nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $primerApellido;

    /**
     * @var string
     *
     * @ORM\Column(name="segundo_apellido", type="string", length=30, nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $segundoApellido;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=1024, nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="grupo_sanguineo", type="string", length=10, nullable=true)
     * @Assert\Choice(choices={"A+","A-","B+","B-","O+","O-","AB+","AB-"})
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $grupoSanguineo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_pacientes", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="pacientes_id_pacientes_seq", allocationSize=1, initialValue=1)
     */
    private $idPacientes;

    /**
     * @var \AppBundle\Entity\Municipio
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Municipio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="municipio_fk", referencedColumnName="id")
     * })
     * @Assert\NotBlank()
     */
    private $municipioFk;

    /**
     * @var \AppBundle\Entity\Provincia
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Provincia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="provincia_fk", referencedColumnName="id")
     * })
     * @Assert\NotBlank()
     */
    private $provinciaFk;

    /**
     * @var \AppBundle\Entity\Sexo
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Sexo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sexo_fk", referencedColumnName="id_sexo")
     * })
     * @Assert\NotBlank()
     */
    private $sexoFk;

    /**
     * @var \AppBundle\Entity\Raza
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Raza")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="raza_fk", referencedColumnName="id_raza")
     * })
     */
    private $razaFk;

    /**
     * @var \AppBundle\Entity\EstadoCivil
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\EstadoCivil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estado_civil_fk", referencedColumnName="id_estado_civil")
     * })
     */
    private $estadoCivilFk;



    /**
     * Set historiaClinica
     *
     * @param string $historiaClinica
     *
     * @return Pacientes
     */
    public function setHistoriaClinica($historiaClinica)
    {
        $this->historiaClinica = $historiaClinica;

        return $this;
    }

    /**
     * Get historiaClinica
     *
     * @return string
     */
    public function getHistoriaClinica()
    {
        return $this->historiaClinica;
    }

    /**
     * Set ci
     *
     * @param string $ci
     *
     * @return Pacientes
     */
    public function setCi($ci)
    {
        $this->ci = $ci;

        return $this;
    }

    /**
     * Get ci
     *
     * @return string
     */
    public function getCi()
    {
        return $this->ci;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Pacientes
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
     * Set primerApellido
     *
     * @param string $primerApellido
     *
     * @return Pacientes
     */
    public function setPrimerApellido($primerApellido)
    {
        $this->primerApellido = $primerApellido;

        return $this;
    }

    /**
     * Get primerApellido
     *
     * @return string
     */
    public function getPrimerApellido()
    {
        return $this->primerApellido;
    }

    /**
     * Set segundoApellido
     *
     * @param string $segundoApellido
     *
     * @return Pacientes
     */
    public function setSegundoApellido($segundoApellido)
    {
        $this->segundoApellido = $segundoApellido;

        return $this;
    }

    /**
     * Get segundoApellido
     *
     * @return string
     */
    public function getSegundoApellido()
    {
        return $this->segundoApellido;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Pacientes
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set grupoSanguineo
     *
     * @param string $grupoSanguineo
     *
     * @return Pacientes
     */
    public function setGrupoSanguineo($grupoSanguineo)
    {
        $this->grupoSanguineo = $grupoSanguineo;

        return $this;
    }

    /**
     * Get grupoSanguineo
     *
     * @return string
     */
    public function getGrupoSanguineo()
    {
        return $this->grupoSanguineo;
    }

    /**
     * Get idPacientes
     *
     * @return integer
     */
    public function getIdPacientes()
    {
        return $this->idPacientes;
    }

    /**
     * Set municipioFk
     *
     * @param \AppBundle\Entity\Municipio $municipioFk
     *
     * @return Pacientes
     */
    public function setMunicipioFk(\AppBundle\Entity\Municipio $municipioFk = null)
    {
        $this->municipioFk = $municipioFk;

        return $this;
    }

    /**
     * Get municipioFk
     *
     * @return \AppBundle\Entity\Municipio
     */
    public function getMunicipioFk()
    {
        return $this->municipioFk;
    }

    /**
     * Set provinciaFk
     *
     * @param \AppBundle\Entity\Provincia $provinciaFk
     *
     * @return Pacientes
     */
    public function setProvinciaFk(\AppBundle\Entity\Provincia $provinciaFk = null)
    {
        $this->provinciaFk = $provinciaFk;

        return $this;
    }

    /**
     * Get provinciaFk
     *
     * @return \AppBundle\Entity\Provincia
     */
    public function getProvinciaFk()
    {
        return $this->provinciaFk;
    }

    /**
     * Set sexoFk
     *
     * @param \AppBundle\Entity\Sexo $sexoFk
     *
     * @return Pacientes
     */
    public function setSexoFk(\AppBundle\Entity\Sexo $sexoFk = null)
    {
        $this->sexoFk = $sexoFk;

        return $this;
    }

    /**
     * Get sexoFk
     *
     * @return \AppBundle\Entity\Sexo
     */
    public function getSexoFk()
    {
        return $this->sexoFk;
    }

    /**
     * Set razaFk
     *
     * @param \AppBundle\Entity\Raza $razaFk
     *
     * @return Pacientes
     */
    public function setRazaFk(\AppBundle\Entity\Raza $razaFk = null)
    {
        $this->razaFk = $razaFk;

        return $this;
    }

    /**
     * Get razaFk
     *
     * @return \AppBundle\Entity\Raza
     */
    public function getRazaFk()
    {
        return $this->razaFk;
    }

    /**
     * Set estadoCivilFk
     *
     * @param \AppBundle\Entity\EstadoCivil $estadoCivilFk
     *
     * @return Pacientes
     */
    public function setEstadoCivilFk(\AppBundle\Entity\EstadoCivil $estadoCivilFk = null)
    {
        $this->estadoCivilFk = $estadoCivilFk;

        return $this;
    }

    /**
     * Get estadoCivilFk
     *
     * @return \AppBundle\Entity\EstadoCivil
     */
    public function getEstadoCivilFk()
    {
        return $this->estadoCivilFk;
    }

    public function nombreCompleto()
    {
        return $this->getNombre() . ' ' . $this->getPrimerApellido().' '. $this->getSegundoApellido();
    }
}
