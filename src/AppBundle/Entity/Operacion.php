<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Operacion
 *
 * @ORM\Table(name="operacion", indexes={@ORM\Index(name="IDX_D44FC94B6437DB8A", columns={"paciente_fk"}), @ORM\Index(name="IDX_D44FC94B92A8E699", columns={"cirujano_fk"}), @ORM\Index(name="IDX_D44FC94BBAB324AA", columns={"anestesista_fk"}), @ORM\Index(name="IDX_D44FC94B3CE9E6B9", columns={"primer_ayudante_fk"}), @ORM\Index(name="IDX_D44FC94BC564DD53", columns={"perfusionista_fk"}), @ORM\Index(name="IDX_D44FC94BADDC551D", columns={"clasif_oper_tipo_1_fk"}), @ORM\Index(name="IDX_D44FC94BBF69FAF3", columns={"clasif_oper_tipo_2_fk"}), @ORM\Index(name="IDX_D44FC94B7D59D96", columns={"clasif_oper_tipo_3_fk"}), @ORM\Index(name="IDX_D44FC94B124DEA4C", columns={"codificacion_fk"}), @ORM\Index(name="IDX_D44FC94BE44C8281", columns={"metodo_anestesico_fk"}), @ORM\Index(name="IDX_D44FC94B84B1DBA9", columns={"agente_anestesico_fk"}), @ORM\Index(name="IDX_D44FC94B9D155980", columns={"diagnostico_clinico_fk"}), @ORM\Index(name="IDX_D44FC94BED162627", columns={"operacion_realizada_fk"}), @ORM\Index(name="IDX_D44FC94BCE4A5242", columns={"tipo_protesis_fk"}), @ORM\Index(name="IDX_D44FC94BD109CB01", columns={"enfermera_fk"}), @ORM\Index(name="IDX_D44FC94BD23BDE61", columns={"sala_fk"}), @ORM\Index(name="IDX_D44FC94B5725ECB", columns={"medico_asistencia_fk"}), @ORM\Index(name="IDX_D44FC94B1964F763", columns={"estado_salir_salon_fk"}), @ORM\Index(name="IDX_D44FC94BCE1465DC", columns={"reflejos_fk"}), @ORM\Index(name="IDX_D44FC94B506F7763", columns={"respiracion_fk"})})
 * @ORM\Entity
 */
class Operacion
{
    /**
     * @var string
     *
     * @ORM\Column(name="folio", type="string", length=50, nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $folio;

    /**
     * @var integer
     *
     * @ORM\Column(name="edad_paciente", type="integer", nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $edadPaciente;

    /**
     * @var string
     *
     * @ORM\Column(name="salon", type="string", length=1, nullable=true)
     * @Assert\Choice(choices={"A","B","C"})
     */
    private $salon;

    /**
     * @var string
     *
     * @ORM\Column(name="cirugia_cardiaca_previa", type="string", length=2, nullable=true)
     */
    private $cirugiaCardiacaPrevia;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_cirugia_previa", type="integer", nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $numeroCirugiaPrevia;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_acto_operatorio", type="text", nullable=true)
     */
    private $descripcionActoOperatorio;

    /**
     * @var string
     *
     * @ORM\Column(name="accidentes_ocurridos", type="text", nullable=true)
     */
    private $accidentesOcurridos;

    /**
     * @var integer
     *
     * @ORM\Column(name="pensamiento_aortico", type="integer", nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $pensamientoAortico;

    /**
     * @var integer
     *
     * @ORM\Column(name="tparo_anoxico", type="integer", nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $tparoAnoxico;

    /**
     * @var integer
     *
     * @ORM\Column(name="tbypass_total", type="integer", nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $tbypassTotal;

    /**
     * @var integer
     *
     * @ORM\Column(name="tbypass_parcial", type="integer", nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $tbypassParcial;

    /**
     * @var integer
     *
     * @ORM\Column(name="tbypass_apoyo", type="integer", nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $tbypassApoyo;

    /**
     * @var integer
     *
     * @ORM\Column(name="no_cardioplegias", type="integer", nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $noCardioplegias;

    /**
     * @var float
     *
     * @ORM\Column(name="trm", type="float", precision=10, scale=0, nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $trm;

    /**
     * @var string
     *
     * @ORM\Column(name="suturas_empleadas", type="text", nullable=true)
     */
    private $suturasEmpleadas;

    /**
     * @var string
     *
     * @ORM\Column(name="drenajes", type="text", nullable=true)
     */
    private $drenajes;

    /**
     * @var string
     *
     * @ORM\Column(name="via_exteorizacion_drenaje", type="text", nullable=true)
     */
    private $viaExteorizacionDrenaje;

    /**
     * @var string
     *
     * @ORM\Column(name="otras_operaciones", type="text", nullable=true)
     */
    private $otrasOperaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="diagnostico_operatorio", type="text", nullable=true)
     */
    private $diagnosticoOperatorio;

    /**
     * @var string
     *
     * @ORM\Column(name="piezas_enviadas_ap", type="text", nullable=true)
     */
    private $piezasEnviadasAp;

    /**
     * @var string
     *
     * @ORM\Column(name="muestras_enviadas_lab", type="text", nullable=true)
     */
    private $muestrasEnviadasLab;

    /**
     * @var float
     *
     * @ORM\Column(name="total_liquido_administrado", type="float", precision=10, scale=0, nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $totalLiquidoAdministrado;

    /**
     * @var float
     *
     * @ORM\Column(name="cant_liquido_aspirador", type="float", precision=10, scale=0, nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $cantLiquidoAspirador;

    /**
     * @var float
     *
     * @ORM\Column(name="sangre", type="float", precision=10, scale=0, nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $sangre;

    /**
     * @var float
     *
     * @ORM\Column(name="globulos", type="float", precision=10, scale=0, nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $globulos;

    /**
     * @var float
     *
     * @ORM\Column(name="plasma", type="float", precision=10, scale=0, nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $plasma;

    /**
     * @var float
     *
     * @ORM\Column(name="dextrosa", type="float", precision=10, scale=0, nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $dextrosa;

    /**
     * @var float
     *
     * @ORM\Column(name="electrolitos_dextran", type="float", precision=10, scale=0, nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $electrolitosDextran;

    /**
     * @var float
     *
     * @ORM\Column(name="clna", type="float", precision=10, scale=0, nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $clna;

    /**
     * @var integer
     *
     * @ORM\Column(name="cant_compresas_g", type="integer", nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $cantCompresasG;

    /**
     * @var integer
     *
     * @ORM\Column(name="cant_compresas_mc", type="integer", nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $cantCompresasMc;

    /**
     * @var integer
     *
     * @ORM\Column(name="cant_compresas_ch", type="integer", nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $cantCompresasCh;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tiempo_quirurgico", type="time", nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $tiempoQuirurgico;

    /**
     * @var float
     *
     * @ORM\Column(name="pulso", type="float", precision=10, scale=0, nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $pulso;

    /**
     * @var string
     *
     * @ORM\Column(name="tension_arterial", type="string", length=25, nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $tensionArterial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $fechaFin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_inicio", type="time", nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $horaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_fin", type="time", nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $horaFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="cama", type="integer", nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $cama;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_elaboracion", type="date", nullable=true)
     * @Assert\NotBlank(message="Por favor llene este campo")
     */
    private $fechaElaboracion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="instrumental_completo", type="boolean", nullable=true)
     */
    private $instrumentalCompleto;

    /**
     * @var boolean
     *
     * @ORM\Column(name="reintervencion", type="boolean", nullable=true)
     */
    private $reintervencion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_operacion", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="operacion_id_operacion_seq", allocationSize=1, initialValue=1)
     */
    private $idOperacion;

    /**
     * @var \AppBundle\Entity\Personal
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Personal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="enfermera_fk", referencedColumnName="id_personal")
     * })
     */
    private $enfermeraFk;

    /**
     * @var \AppBundle\Entity\TipoProtesis
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TipoProtesis")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_protesis_fk", referencedColumnName="id_tipo_protesis")
     * })
     */
    private $tipoProtesisFk;

    /**
     * @var \AppBundle\Entity\OperacionRealizada
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\OperacionRealizada")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="operacion_realizada_fk", referencedColumnName="id_operacion_realizada")
     * })
     */
    private $operacionRealizadaFk;

    /**
     * @var \AppBundle\Entity\DiagnosticoClinico
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DiagnosticoClinico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="diagnostico_clinico_fk", referencedColumnName="id_diagnostico_clinico")
     * })
     */
    private $diagnosticoClinicoFk;

    /**
     * @var \AppBundle\Entity\Sala
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Sala")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sala_fk", referencedColumnName="id_sala")
     * })
     */
    private $salaFk;

    /**
     * @var \AppBundle\Entity\Personal
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Personal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="medico_asistencia_fk", referencedColumnName="id_personal")
     * })
     */
    private $medicoAsistenciaFk;

    /**
     * @var \AppBundle\Entity\Respiracion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Respiracion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="respiracion_fk", referencedColumnName="id_respiracion")
     * })
     */
    private $respiracionFk;

    /**
     * @var \AppBundle\Entity\Reflejos
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Reflejos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reflejos_fk", referencedColumnName="id_reflejos")
     * })
     */
    private $reflejosFk;

    /**
     * @var \AppBundle\Entity\EstadoSalirSalon
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\EstadoSalirSalon")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estado_salir_salon_fk", referencedColumnName="id_estado_salir_salon")
     * })
     */
    private $estadoSalirSalonFk;

    /**
     * @var \AppBundle\Entity\AgenteAnestesico
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AgenteAnestesico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="agente_anestesico_fk", referencedColumnName="id_agente_anestesico")
     * })
     */
    private $agenteAnestesicoFk;

    /**
     * @var \AppBundle\Entity\MetodoAnestesico
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MetodoAnestesico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="metodo_anestesico_fk", referencedColumnName="id_metodo_anestesico")
     * })
     */
    private $metodoAnestesicoFk;

    /**
     * @var \AppBundle\Entity\Personal
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Personal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="primer_ayudante_fk", referencedColumnName="id_personal")
     * })
     */
    private $primerAyudanteFk;

    /**
     * @var \AppBundle\Entity\Personal
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Personal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="anestesista_fk", referencedColumnName="id_personal")
     * })
     */
    private $anestesistaFk;

    /**
     * @var \AppBundle\Entity\Personal
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Personal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cirujano_fk", referencedColumnName="id_personal")
     * })
     */
    private $cirujanoFk;

    /**
     * @var \AppBundle\Entity\Personal
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Personal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="perfusionista_fk", referencedColumnName="id_personal")
     * })
     */
    private $perfusionistaFk;

    /**
     * @var \AppBundle\Entity\ClasifOperTipo1
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ClasifOperTipo1")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="clasif_oper_tipo_1_fk", referencedColumnName="id_clasif_oper_tipo_1")
     * })
     */
    private $clasifOperTipo1Fk;

    /**
     * @var \AppBundle\Entity\Codificacion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Codificacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="codificacion_fk", referencedColumnName="id_codificacion")
     * })
     */
    private $codificacionFk;

    /**
     * @var \AppBundle\Entity\ClasifOperTipo3
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ClasifOperTipo3")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="clasif_oper_tipo_3_fk", referencedColumnName="id_clasif_oper_tipo_3")
     * })
     */
    private $clasifOperTipo3Fk;

    /**
     * @var \AppBundle\Entity\ClasifOperTipo2
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ClasifOperTipo2")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="clasif_oper_tipo_2_fk", referencedColumnName="id_clasif_oper_tipo_2")
     * })
     */
    private $clasifOperTipo2Fk;

    /**
     * @var \AppBundle\Entity\Pacientes
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Pacientes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="paciente_fk", referencedColumnName="id_pacientes")
     * })
     */
    private $pacienteFk;



    /**
     * Set folio
     *
     * @param string $folio
     *
     * @return Operacion
     */
    public function setFolio($folio)
    {
        $this->folio = $folio;

        return $this;
    }

    /**
     * Get folio
     *
     * @return string
     */
    public function getFolio()
    {
        return $this->folio;
    }

    /**
     * Set edadPaciente
     *
     * @param integer $edadPaciente
     *
     * @return Operacion
     */
    public function setEdadPaciente($edadPaciente)
    {
        $this->edadPaciente = $edadPaciente;

        return $this;
    }

    /**
     * Get edadPaciente
     *
     * @return integer
     */
    public function getEdadPaciente()
    {
        return $this->edadPaciente;
    }

    /**
     * Set salon
     *
     * @param string $salon
     *
     * @return Operacion
     */
    public function setSalon($salon)
    {
        $this->salon = $salon;

        return $this;
    }

    /**
     * Get salon
     *
     * @return string
     */
    public function getSalon()
    {
        return $this->salon;
    }

    /**
     * Set cirugiaCardiacaPrevia
     *
     * @param string $cirugiaCardiacaPrevia
     *
     * @return Operacion
     */
    public function setCirugiaCardiacaPrevia($cirugiaCardiacaPrevia)
    {
        $this->cirugiaCardiacaPrevia = $cirugiaCardiacaPrevia;

        return $this;
    }

    /**
     * Get cirugiaCardiacaPrevia
     *
     * @return string
     */
    public function getCirugiaCardiacaPrevia()
    {
        return $this->cirugiaCardiacaPrevia;
    }

    /**
     * Set numeroCirugiaPrevia
     *
     * @param integer $numeroCirugiaPrevia
     *
     * @return Operacion
     */
    public function setNumeroCirugiaPrevia($numeroCirugiaPrevia)
    {
        $this->numeroCirugiaPrevia = $numeroCirugiaPrevia;

        return $this;
    }

    /**
     * Get numeroCirugiaPrevia
     *
     * @return integer
     */
    public function getNumeroCirugiaPrevia()
    {
        return $this->numeroCirugiaPrevia;
    }

    /**
     * Set descripcionActoOperatorio
     *
     * @param string $descripcionActoOperatorio
     *
     * @return Operacion
     */
    public function setDescripcionActoOperatorio($descripcionActoOperatorio)
    {
        $this->descripcionActoOperatorio = $descripcionActoOperatorio;

        return $this;
    }

    /**
     * Get descripcionActoOperatorio
     *
     * @return string
     */
    public function getDescripcionActoOperatorio()
    {
        return $this->descripcionActoOperatorio;
    }

    /**
     * Set accidentesOcurridos
     *
     * @param string $accidentesOcurridos
     *
     * @return Operacion
     */
    public function setAccidentesOcurridos($accidentesOcurridos)
    {
        $this->accidentesOcurridos = $accidentesOcurridos;

        return $this;
    }

    /**
     * Get accidentesOcurridos
     *
     * @return string
     */
    public function getAccidentesOcurridos()
    {
        return $this->accidentesOcurridos;
    }

    /**
     * Set pensamientoAortico
     *
     * @param integer $pensamientoAortico
     *
     * @return Operacion
     */
    public function setPensamientoAortico($pensamientoAortico)
    {
        $this->pensamientoAortico = $pensamientoAortico;

        return $this;
    }

    /**
     * Get pensamientoAortico
     *
     * @return integer
     */
    public function getPensamientoAortico()
    {
        return $this->pensamientoAortico;
    }

    /**
     * Set tparoAnoxico
     *
     * @param integer $tparoAnoxico
     *
     * @return Operacion
     */
    public function setTparoAnoxico($tparoAnoxico)
    {
        $this->tparoAnoxico = $tparoAnoxico;

        return $this;
    }

    /**
     * Get tparoAnoxico
     *
     * @return integer
     */
    public function getTparoAnoxico()
    {
        return $this->tparoAnoxico;
    }

    /**
     * Set tbypassTotal
     *
     * @param integer $tbypassTotal
     *
     * @return Operacion
     */
    public function setTbypassTotal($tbypassTotal)
    {
        $this->tbypassTotal = $tbypassTotal;

        return $this;
    }

    /**
     * Get tbypassTotal
     *
     * @return integer
     */
    public function getTbypassTotal()
    {
        return $this->tbypassTotal;
    }

    /**
     * Set tbypassParcial
     *
     * @param integer $tbypassParcial
     *
     * @return Operacion
     */
    public function setTbypassParcial($tbypassParcial)
    {
        $this->tbypassParcial = $tbypassParcial;

        return $this;
    }

    /**
     * Get tbypassParcial
     *
     * @return integer
     */
    public function getTbypassParcial()
    {
        return $this->tbypassParcial;
    }

    /**
     * Set tbypassApoyo
     *
     * @param integer $tbypassApoyo
     *
     * @return Operacion
     */
    public function setTbypassApoyo($tbypassApoyo)
    {
        $this->tbypassApoyo = $tbypassApoyo;

        return $this;
    }

    /**
     * Get tbypassApoyo
     *
     * @return integer
     */
    public function getTbypassApoyo()
    {
        return $this->tbypassApoyo;
    }

    /**
     * Set noCardioplegias
     *
     * @param integer $noCardioplegias
     *
     * @return Operacion
     */
    public function setNoCardioplegias($noCardioplegias)
    {
        $this->noCardioplegias = $noCardioplegias;

        return $this;
    }

    /**
     * Get noCardioplegias
     *
     * @return integer
     */
    public function getNoCardioplegias()
    {
        return $this->noCardioplegias;
    }

    /**
     * Set trm
     *
     * @param float $trm
     *
     * @return Operacion
     */
    public function setTrm($trm)
    {
        $this->trm = $trm;

        return $this;
    }

    /**
     * Get trm
     *
     * @return float
     */
    public function getTrm()
    {
        return $this->trm;
    }

    /**
     * Set suturasEmpleadas
     *
     * @param string $suturasEmpleadas
     *
     * @return Operacion
     */
    public function setSuturasEmpleadas($suturasEmpleadas)
    {
        $this->suturasEmpleadas = $suturasEmpleadas;

        return $this;
    }

    /**
     * Get suturasEmpleadas
     *
     * @return string
     */
    public function getSuturasEmpleadas()
    {
        return $this->suturasEmpleadas;
    }

    /**
     * Set drenajes
     *
     * @param string $drenajes
     *
     * @return Operacion
     */
    public function setDrenajes($drenajes)
    {
        $this->drenajes = $drenajes;

        return $this;
    }

    /**
     * Get drenajes
     *
     * @return string
     */
    public function getDrenajes()
    {
        return $this->drenajes;
    }

    /**
     * Set viaExteorizacionDrenaje
     *
     * @param string $viaExteorizacionDrenaje
     *
     * @return Operacion
     */
    public function setViaExteorizacionDrenaje($viaExteorizacionDrenaje)
    {
        $this->viaExteorizacionDrenaje = $viaExteorizacionDrenaje;

        return $this;
    }

    /**
     * Get viaExteorizacionDrenaje
     *
     * @return string
     */
    public function getViaExteorizacionDrenaje()
    {
        return $this->viaExteorizacionDrenaje;
    }

    /**
     * Set otrasOperaciones
     *
     * @param string $otrasOperaciones
     *
     * @return Operacion
     */
    public function setOtrasOperaciones($otrasOperaciones)
    {
        $this->otrasOperaciones = $otrasOperaciones;

        return $this;
    }

    /**
     * Get otrasOperaciones
     *
     * @return string
     */
    public function getOtrasOperaciones()
    {
        return $this->otrasOperaciones;
    }

    /**
     * Set diagnosticoOperatorio
     *
     * @param string $diagnosticoOperatorio
     *
     * @return Operacion
     */
    public function setDiagnosticoOperatorio($diagnosticoOperatorio)
    {
        $this->diagnosticoOperatorio = $diagnosticoOperatorio;

        return $this;
    }

    /**
     * Get diagnosticoOperatorio
     *
     * @return string
     */
    public function getDiagnosticoOperatorio()
    {
        return $this->diagnosticoOperatorio;
    }

    /**
     * Set piezasEnviadasAp
     *
     * @param string $piezasEnviadasAp
     *
     * @return Operacion
     */
    public function setPiezasEnviadasAp($piezasEnviadasAp)
    {
        $this->piezasEnviadasAp = $piezasEnviadasAp;

        return $this;
    }

    /**
     * Get piezasEnviadasAp
     *
     * @return string
     */
    public function getPiezasEnviadasAp()
    {
        return $this->piezasEnviadasAp;
    }

    /**
     * Set muestrasEnviadasLab
     *
     * @param string $muestrasEnviadasLab
     *
     * @return Operacion
     */
    public function setMuestrasEnviadasLab($muestrasEnviadasLab)
    {
        $this->muestrasEnviadasLab = $muestrasEnviadasLab;

        return $this;
    }

    /**
     * Get muestrasEnviadasLab
     *
     * @return string
     */
    public function getMuestrasEnviadasLab()
    {
        return $this->muestrasEnviadasLab;
    }

    /**
     * Set totalLiquidoAdministrado
     *
     * @param float $totalLiquidoAdministrado
     *
     * @return Operacion
     */
    public function setTotalLiquidoAdministrado($totalLiquidoAdministrado)
    {
        $this->totalLiquidoAdministrado = $totalLiquidoAdministrado;

        return $this;
    }

    /**
     * Get totalLiquidoAdministrado
     *
     * @return float
     */
    public function getTotalLiquidoAdministrado()
    {
        return $this->totalLiquidoAdministrado;
    }

    /**
     * Set cantLiquidoAspirador
     *
     * @param float $cantLiquidoAspirador
     *
     * @return Operacion
     */
    public function setCantLiquidoAspirador($cantLiquidoAspirador)
    {
        $this->cantLiquidoAspirador = $cantLiquidoAspirador;

        return $this;
    }

    /**
     * Get cantLiquidoAspirador
     *
     * @return float
     */
    public function getCantLiquidoAspirador()
    {
        return $this->cantLiquidoAspirador;
    }

    /**
     * Set sangre
     *
     * @param float $sangre
     *
     * @return Operacion
     */
    public function setSangre($sangre)
    {
        $this->sangre = $sangre;

        return $this;
    }

    /**
     * Get sangre
     *
     * @return float
     */
    public function getSangre()
    {
        return $this->sangre;
    }

    /**
     * Set globulos
     *
     * @param float $globulos
     *
     * @return Operacion
     */
    public function setGlobulos($globulos)
    {
        $this->globulos = $globulos;

        return $this;
    }

    /**
     * Get globulos
     *
     * @return float
     */
    public function getGlobulos()
    {
        return $this->globulos;
    }

    /**
     * Set plasma
     *
     * @param float $plasma
     *
     * @return Operacion
     */
    public function setPlasma($plasma)
    {
        $this->plasma = $plasma;

        return $this;
    }

    /**
     * Get plasma
     *
     * @return float
     */
    public function getPlasma()
    {
        return $this->plasma;
    }

    /**
     * Set dextrosa
     *
     * @param float $dextrosa
     *
     * @return Operacion
     */
    public function setDextrosa($dextrosa)
    {
        $this->dextrosa = $dextrosa;

        return $this;
    }

    /**
     * Get dextrosa
     *
     * @return float
     */
    public function getDextrosa()
    {
        return $this->dextrosa;
    }

    /**
     * Set electrolitosDextran
     *
     * @param float $electrolitosDextran
     *
     * @return Operacion
     */
    public function setElectrolitosDextran($electrolitosDextran)
    {
        $this->electrolitosDextran = $electrolitosDextran;

        return $this;
    }

    /**
     * Get electrolitosDextran
     *
     * @return float
     */
    public function getElectrolitosDextran()
    {
        return $this->electrolitosDextran;
    }

    /**
     * Set clna
     *
     * @param float $clna
     *
     * @return Operacion
     */
    public function setClna($clna)
    {
        $this->clna = $clna;

        return $this;
    }

    /**
     * Get clna
     *
     * @return float
     */
    public function getClna()
    {
        return $this->clna;
    }

    /**
     * Set cantCompresasG
     *
     * @param integer $cantCompresasG
     *
     * @return Operacion
     */
    public function setCantCompresasG($cantCompresasG)
    {
        $this->cantCompresasG = $cantCompresasG;

        return $this;
    }

    /**
     * Get cantCompresasG
     *
     * @return integer
     */
    public function getCantCompresasG()
    {
        return $this->cantCompresasG;
    }

    /**
     * Set cantCompresasMc
     *
     * @param integer $cantCompresasMc
     *
     * @return Operacion
     */
    public function setCantCompresasMc($cantCompresasMc)
    {
        $this->cantCompresasMc = $cantCompresasMc;

        return $this;
    }

    /**
     * Get cantCompresasMc
     *
     * @return integer
     */
    public function getCantCompresasMc()
    {
        return $this->cantCompresasMc;
    }

    /**
     * Set cantCompresasCh
     *
     * @param integer $cantCompresasCh
     *
     * @return Operacion
     */
    public function setCantCompresasCh($cantCompresasCh)
    {
        $this->cantCompresasCh = $cantCompresasCh;

        return $this;
    }

    /**
     * Get cantCompresasCh
     *
     * @return integer
     */
    public function getCantCompresasCh()
    {
        return $this->cantCompresasCh;
    }

    /**
     * Set tiempoQuirurgico
     *
     * @param \DateTime $tiempoQuirurgico
     *
     * @return Operacion
     */
    public function setTiempoQuirurgico($tiempoQuirurgico)
    {
        $this->tiempoQuirurgico = $tiempoQuirurgico;

        return $this;
    }

    /**
     * Get tiempoQuirurgico
     *
     * @return \DateTime
     */
    public function getTiempoQuirurgico()
    {
        return $this->tiempoQuirurgico;
    }

    /**
     * Set pulso
     *
     * @param float $pulso
     *
     * @return Operacion
     */
    public function setPulso($pulso)
    {
        $this->pulso = $pulso;

        return $this;
    }

    /**
     * Get pulso
     *
     * @return float
     */
    public function getPulso()
    {
        return $this->pulso;
    }

    /**
     * Set tensionArterial
     *
     * @param string $tensionArterial
     *
     * @return Operacion
     */
    public function setTensionArterial($tensionArterial)
    {
        $this->tensionArterial = $tensionArterial;

        return $this;
    }

    /**
     * Get tensionArterial
     *
     * @return string
     */
    public function getTensionArterial()
    {
        return $this->tensionArterial;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     *
     * @return Operacion
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     *
     * @return Operacion
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set horaInicio
     *
     * @param \DateTime $horaInicio
     *
     * @return Operacion
     */
    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    /**
     * Get horaInicio
     *
     * @return \DateTime
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * Set horaFin
     *
     * @param \DateTime $horaFin
     *
     * @return Operacion
     */
    public function setHoraFin($horaFin)
    {
        $this->horaFin = $horaFin;

        return $this;
    }

    /**
     * Get horaFin
     *
     * @return \DateTime
     */
    public function getHoraFin()
    {
        return $this->horaFin;
    }

    /**
     * Set cama
     *
     * @param integer $cama
     *
     * @return Operacion
     */
    public function setCama($cama)
    {
        $this->cama = $cama;

        return $this;
    }

    /**
     * Get cama
     *
     * @return integer
     */
    public function getCama()
    {
        return $this->cama;
    }

    /**
     * Set fechaElaboracion
     *
     * @param \DateTime $fechaElaboracion
     *
     * @return Operacion
     */
    public function setFechaElaboracion($fechaElaboracion)
    {
        $this->fechaElaboracion = $fechaElaboracion;

        return $this;
    }

    /**
     * Get fechaElaboracion
     *
     * @return \DateTime
     */
    public function getFechaElaboracion()
    {
        return $this->fechaElaboracion;
    }

    /**
     * Set instrumentalCompleto
     *
     * @param boolean $instrumentalCompleto
     *
     * @return Operacion
     */
    public function setInstrumentalCompleto($instrumentalCompleto)
    {
        $this->instrumentalCompleto = $instrumentalCompleto;

        return $this;
    }

    /**
     * Get instrumentalCompleto
     *
     * @return boolean
     */
    public function getInstrumentalCompleto()
    {
        return $this->instrumentalCompleto;
    }

    /**
     * Set reintervencion
     *
     * @param boolean $reintervencion
     *
     * @return Operacion
     */
    public function setReintervencion($reintervencion)
    {
        $this->reintervencion = $reintervencion;

        return $this;
    }

    /**
     * Get reintervencion
     *
     * @return boolean
     */
    public function getReintervencion()
    {
        return $this->reintervencion;
    }

    /**
     * Get idOperacion
     *
     * @return integer
     */
    public function getIdOperacion()
    {
        return $this->idOperacion;
    }

    /**
     * Set enfermeraFk
     *
     * @param \AppBundle\Entity\Personal $enfermeraFk
     *
     * @return Operacion
     */
    public function setEnfermeraFk(\AppBundle\Entity\Personal $enfermeraFk = null)
    {
        $this->enfermeraFk = $enfermeraFk;

        return $this;
    }

    /**
     * Get enfermeraFk
     *
     * @return \AppBundle\Entity\Personal
     */
    public function getEnfermeraFk()
    {
        return $this->enfermeraFk;
    }

    /**
     * Set tipoProtesisFk
     *
     * @param \AppBundle\Entity\TipoProtesis $tipoProtesisFk
     *
     * @return Operacion
     */
    public function setTipoProtesisFk(\AppBundle\Entity\TipoProtesis $tipoProtesisFk = null)
    {
        $this->tipoProtesisFk = $tipoProtesisFk;

        return $this;
    }

    /**
     * Get tipoProtesisFk
     *
     * @return \AppBundle\Entity\TipoProtesis
     */
    public function getTipoProtesisFk()
    {
        return $this->tipoProtesisFk;
    }

    /**
     * Set operacionRealizadaFk
     *
     * @param \AppBundle\Entity\OperacionRealizada $operacionRealizadaFk
     *
     * @return Operacion
     */
    public function setOperacionRealizadaFk(\AppBundle\Entity\OperacionRealizada $operacionRealizadaFk = null)
    {
        $this->operacionRealizadaFk = $operacionRealizadaFk;

        return $this;
    }

    /**
     * Get operacionRealizadaFk
     *
     * @return \AppBundle\Entity\OperacionRealizada
     */
    public function getOperacionRealizadaFk()
    {
        return $this->operacionRealizadaFk;
    }

    /**
     * Set diagnosticoClinicoFk
     *
     * @param \AppBundle\Entity\DiagnosticoClinico $diagnosticoClinicoFk
     *
     * @return Operacion
     */
    public function setDiagnosticoClinicoFk(\AppBundle\Entity\DiagnosticoClinico $diagnosticoClinicoFk = null)
    {
        $this->diagnosticoClinicoFk = $diagnosticoClinicoFk;

        return $this;
    }

    /**
     * Get diagnosticoClinicoFk
     *
     * @return \AppBundle\Entity\DiagnosticoClinico
     */
    public function getDiagnosticoClinicoFk()
    {
        return $this->diagnosticoClinicoFk;
    }

    /**
     * Set salaFk
     *
     * @param \AppBundle\Entity\Sala $salaFk
     *
     * @return Operacion
     */
    public function setSalaFk(\AppBundle\Entity\Sala $salaFk = null)
    {
        $this->salaFk = $salaFk;

        return $this;
    }

    /**
     * Get salaFk
     *
     * @return \AppBundle\Entity\Sala
     */
    public function getSalaFk()
    {
        return $this->salaFk;
    }

    /**
     * Set medicoAsistenciaFk
     *
     * @param \AppBundle\Entity\Personal $medicoAsistenciaFk
     *
     * @return Operacion
     */
    public function setMedicoAsistenciaFk(\AppBundle\Entity\Personal $medicoAsistenciaFk = null)
    {
        $this->medicoAsistenciaFk = $medicoAsistenciaFk;

        return $this;
    }

    /**
     * Get medicoAsistenciaFk
     *
     * @return \AppBundle\Entity\Personal
     */
    public function getMedicoAsistenciaFk()
    {
        return $this->medicoAsistenciaFk;
    }

    /**
     * Set respiracionFk
     *
     * @param \AppBundle\Entity\Respiracion $respiracionFk
     *
     * @return Operacion
     */
    public function setRespiracionFk(\AppBundle\Entity\Respiracion $respiracionFk = null)
    {
        $this->respiracionFk = $respiracionFk;

        return $this;
    }

    /**
     * Get respiracionFk
     *
     * @return \AppBundle\Entity\Respiracion
     */
    public function getRespiracionFk()
    {
        return $this->respiracionFk;
    }

    /**
     * Set reflejosFk
     *
     * @param \AppBundle\Entity\Reflejos $reflejosFk
     *
     * @return Operacion
     */
    public function setReflejosFk(\AppBundle\Entity\Reflejos $reflejosFk = null)
    {
        $this->reflejosFk = $reflejosFk;

        return $this;
    }

    /**
     * Get reflejosFk
     *
     * @return \AppBundle\Entity\Reflejos
     */
    public function getReflejosFk()
    {
        return $this->reflejosFk;
    }

    /**
     * Set estadoSalirSalonFk
     *
     * @param \AppBundle\Entity\EstadoSalirSalon $estadoSalirSalonFk
     *
     * @return Operacion
     */
    public function setEstadoSalirSalonFk(\AppBundle\Entity\EstadoSalirSalon $estadoSalirSalonFk = null)
    {
        $this->estadoSalirSalonFk = $estadoSalirSalonFk;

        return $this;
    }

    /**
     * Get estadoSalirSalonFk
     *
     * @return \AppBundle\Entity\EstadoSalirSalon
     */
    public function getEstadoSalirSalonFk()
    {
        return $this->estadoSalirSalonFk;
    }

    /**
     * Set agenteAnestesicoFk
     *
     * @param \AppBundle\Entity\AgenteAnestesico $agenteAnestesicoFk
     *
     * @return Operacion
     */
    public function setAgenteAnestesicoFk(\AppBundle\Entity\AgenteAnestesico $agenteAnestesicoFk = null)
    {
        $this->agenteAnestesicoFk = $agenteAnestesicoFk;

        return $this;
    }

    /**
     * Get agenteAnestesicoFk
     *
     * @return \AppBundle\Entity\AgenteAnestesico
     */
    public function getAgenteAnestesicoFk()
    {
        return $this->agenteAnestesicoFk;
    }

    /**
     * Set metodoAnestesicoFk
     *
     * @param \AppBundle\Entity\MetodoAnestesico $metodoAnestesicoFk
     *
     * @return Operacion
     */
    public function setMetodoAnestesicoFk(\AppBundle\Entity\MetodoAnestesico $metodoAnestesicoFk = null)
    {
        $this->metodoAnestesicoFk = $metodoAnestesicoFk;

        return $this;
    }

    /**
     * Get metodoAnestesicoFk
     *
     * @return \AppBundle\Entity\MetodoAnestesico
     */
    public function getMetodoAnestesicoFk()
    {
        return $this->metodoAnestesicoFk;
    }

    /**
     * Set primerAyudanteFk
     *
     * @param \AppBundle\Entity\Personal $primerAyudanteFk
     *
     * @return Operacion
     */
    public function setPrimerAyudanteFk(\AppBundle\Entity\Personal $primerAyudanteFk = null)
    {
        $this->primerAyudanteFk = $primerAyudanteFk;

        return $this;
    }

    /**
     * Get primerAyudanteFk
     *
     * @return \AppBundle\Entity\Personal
     */
    public function getPrimerAyudanteFk()
    {
        return $this->primerAyudanteFk;
    }

    /**
     * Set anestesistaFk
     *
     * @param \AppBundle\Entity\Personal $anestesistaFk
     *
     * @return Operacion
     */
    public function setAnestesistaFk(\AppBundle\Entity\Personal $anestesistaFk = null)
    {
        $this->anestesistaFk = $anestesistaFk;

        return $this;
    }

    /**
     * Get anestesistaFk
     *
     * @return \AppBundle\Entity\Personal
     */
    public function getAnestesistaFk()
    {
        return $this->anestesistaFk;
    }

    /**
     * Set cirujanoFk
     *
     * @param \AppBundle\Entity\Personal $cirujanoFk
     *
     * @return Operacion
     */
    public function setCirujanoFk(\AppBundle\Entity\Personal $cirujanoFk = null)
    {
        $this->cirujanoFk = $cirujanoFk;

        return $this;
    }

    /**
     * Get cirujanoFk
     *
     * @return \AppBundle\Entity\Personal
     */
    public function getCirujanoFk()
    {
        return $this->cirujanoFk;
    }

    /**
     * Set perfusionistaFk
     *
     * @param \AppBundle\Entity\Personal $perfusionistaFk
     *
     * @return Operacion
     */
    public function setPerfusionistaFk(\AppBundle\Entity\Personal $perfusionistaFk = null)
    {
        $this->perfusionistaFk = $perfusionistaFk;

        return $this;
    }

    /**
     * Get perfusionistaFk
     *
     * @return \AppBundle\Entity\Personal
     */
    public function getPerfusionistaFk()
    {
        return $this->perfusionistaFk;
    }

    /**
     * Set clasifOperTipo1Fk
     *
     * @param \AppBundle\Entity\ClasifOperTipo1 $clasifOperTipo1Fk
     *
     * @return Operacion
     */
    public function setClasifOperTipo1Fk(\AppBundle\Entity\ClasifOperTipo1 $clasifOperTipo1Fk = null)
    {
        $this->clasifOperTipo1Fk = $clasifOperTipo1Fk;

        return $this;
    }

    /**
     * Get clasifOperTipo1Fk
     *
     * @return \AppBundle\Entity\ClasifOperTipo1
     */
    public function getClasifOperTipo1Fk()
    {
        return $this->clasifOperTipo1Fk;
    }

    /**
     * Set codificacionFk
     *
     * @param \AppBundle\Entity\Codificacion $codificacionFk
     *
     * @return Operacion
     */
    public function setCodificacionFk(\AppBundle\Entity\Codificacion $codificacionFk = null)
    {
        $this->codificacionFk = $codificacionFk;

        return $this;
    }

    /**
     * Get codificacionFk
     *
     * @return \AppBundle\Entity\Codificacion
     */
    public function getCodificacionFk()
    {
        return $this->codificacionFk;
    }

    /**
     * Set clasifOperTipo3Fk
     *
     * @param \AppBundle\Entity\ClasifOperTipo3 $clasifOperTipo3Fk
     *
     * @return Operacion
     */
    public function setClasifOperTipo3Fk(\AppBundle\Entity\ClasifOperTipo3 $clasifOperTipo3Fk = null)
    {
        $this->clasifOperTipo3Fk = $clasifOperTipo3Fk;

        return $this;
    }

    /**
     * Get clasifOperTipo3Fk
     *
     * @return \AppBundle\Entity\ClasifOperTipo3
     */
    public function getClasifOperTipo3Fk()
    {
        return $this->clasifOperTipo3Fk;
    }

    /**
     * Set clasifOperTipo2Fk
     *
     * @param \AppBundle\Entity\ClasifOperTipo2 $clasifOperTipo2Fk
     *
     * @return Operacion
     */
    public function setClasifOperTipo2Fk(\AppBundle\Entity\ClasifOperTipo2 $clasifOperTipo2Fk = null)
    {
        $this->clasifOperTipo2Fk = $clasifOperTipo2Fk;

        return $this;
    }

    /**
     * Get clasifOperTipo2Fk
     *
     * @return \AppBundle\Entity\ClasifOperTipo2
     */
    public function getClasifOperTipo2Fk()
    {
        return $this->clasifOperTipo2Fk;
    }

    /**
     * Set pacienteFk
     *
     * @param \AppBundle\Entity\Pacientes $pacienteFk
     *
     * @return Operacion
     */
    public function setPacienteFk(\AppBundle\Entity\Pacientes $pacienteFk = null)
    {
        $this->pacienteFk = $pacienteFk;

        return $this;
    }

    /**
     * Get pacienteFk
     *
     * @return \AppBundle\Entity\Pacientes
     */
    public function getPacienteFk()
    {
        return $this->pacienteFk;
    }
}
