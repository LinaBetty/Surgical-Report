<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AyudantesOperacion;
use AppBundle\Entity\Operacion;
use AppBundle\Entity\OperacionModif;
use AppBundle\Entity\Traza;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * Operacion controller.
 *
 * @Route("operacion")
 */
class OperacionController extends Controller
{
    /**
     * Lists all operacion entities.
     *
     * @Route("/", name="operacion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository(OperacionModif::class);
        $em = $this->getDoctrine()->getManager();
        $operacions = $em->getRepository('AppBundle:Operacion')->findAll();
        $cant = count($operacions);

        $catnmodif = array();
        $modificaciones = array();
        for ($i = 0; $i < count($operacions); $i++) {
            $catnmodif[] = count($repository->findBy(['operacionFk' => $operacions[$i]->getIdOperacion()]));
            $modificaciones[] = $repository->findOneBy(
                ['operacionFk' => $operacions[$i]->getIdOperacion()],
                ['idOperacionModif' => 'DESC']
            );
        }

        return $this->render('operacion/index.html.twig', array(
            'operacions' => $operacions,
            'cantmodificaciones' => $catnmodif,
            'cant' => $cant,
            'modificaciones' => $modificaciones,
        ));
    }

    /**
     * Creates a new operacion entity.
     *
     * @Route("/new", name="operacion_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_MEDICO')")
     */
    public function newAction(Request $request)
    {
        $operacion = new Operacion();
        $form = $this->createForm('AppBundle\Form\OperacionType', $operacion);
        $form->handleRequest($request);

//      Cargando todos los personales para los ayudantes
        $em = $this->getDoctrine()->getManager();
        $personals = $em->getRepository('AppBundle:Personal')->findAll();

        //          Validando entreda de un paciente repetido
        $repository = $this->getDoctrine()->getRepository(Operacion::class);
        $pacienteRepetido = $repository->findOneBy([
            'pacienteFk' => $operacion->getPacienteFk(),
            'fechaInicio' => $operacion->getFechaInicio(),
            'horaInicio' => $operacion->getHoraInicio(),
        ]);
        $ciRepetido = $repository->findOneBy([
            'folio' => $operacion->getFolio(),
        ]);

        if ($pacienteRepetido != null or $ciRepetido!=null) {
//            $form->addError(new FormError('ERROR! El paciente ya existe.'));
            $this->get('session')->getFlashBag()->set(
                'danger',
                array(
                    'title' => 'ERROR!',
                    'message' => 'Ya existe esta operación'
                ));
            return $this->redirect($this->generateUrl('operacion_new'));
        }

        if($operacion->getFechaInicio() > $operacion->getFechaFin()){
            $this->get('session')->getFlashBag()->set(
                'danger',
                array(
                    'title' => 'ERROR!',
                    'message' => 'La fecha de culminación de la operación no puede ser antes de la fecha de comienzo.'
                ));
            return $this->redirect($this->generateUrl('operacion_new'));
        }

        if($operacion->getHoraInicio() > $operacion->getHoraFin()){
            $this->get('session')->getFlashBag()->set(
                'danger',
                array(
                    'title' => 'ERROR!',
                    'message' => 'La hora de culminación de la operación no puede ser antes de la hora de comienzo.'
                ));
            return $this->redirect($this->generateUrl('operacion_new'));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($operacion);
            $em->flush();

//          Obteniendo datos del select multiple para ayudantes e insertandolos
            $ayudantes = $_POST["ayudantes"];
            for ($i = 0; $i < count($ayudantes); $i++) {
                $ayudanteOp = new AyudantesOperacion();
                $ayudanteOp->setOperacionFk($operacion);

                $idAyud = $em->getRepository('AppBundle:Personal')->findOneBy(['nombre' => $ayudantes[$i]]);
                $ayudanteOp->setPersonalFk($idAyud);
                $em->persist($ayudanteOp);
                $em->flush();
            }

            //          Registrando en las trazas la insercion
            $traza = new Traza();
            $traza->setAccionRealizada('Se ha insertado una nueva operacion de folio '.$operacion->getFolio().' y de tipo '.$operacion->getOperacionRealizadaFk()->getNombre());
            $user = $this->getUser();
            $traza->setUsuarioFk($user);
            $fecha = getdate();
            $temp = new \DateTime();
            $temp->setDate($fecha['year'],$fecha['mon'],$fecha['mday']);
            $traza->setFecha($temp);
            $hora = new \DateTime();
            $hora->setTime(date("H"),date("i"),date("s"));
            $hora->format('H:i:s');
            $traza->setHora($hora);
            $em->persist($traza);
            $em->flush();

            $this->get('session')->getFlashBag()->set(
                'danger',
                array(
                    'title' => '',
                    'message' => 'Los datos de la operacion '.$operacion->getFolio().' se han registrado satisfactoriamente.'
                ));
            return $this->redirectToRoute('operacion_show', array('idOperacion' => $operacion->getIdoperacion()));
        }

        return $this->render('operacion/new.html.twig', array(
            'operacion' => $operacion,
            'form' => $form->createView(),
            'personales' => $personals,
            'folio' => $this->armarFolioNuevo(),
        ));
    }

    /**
     * Finds and displays a operacion entity.
     *
     * @Route("/{idOperacion}", name="operacion_show")
     * @Method("GET")
     */
    public function showAction(Operacion $operacion)
    {
        $deleteForm = $this->createDeleteForm($operacion);
//        $em = $this->getDoctrine()->getManager();

//        $entityManager = $this->getEntityManager();
        $entityManager = $this->getDoctrine()->getManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM AppBundle\Entity\AyudantesOperacion p
            WHERE p.operacionFk = :id'
        )->setParameter('id', $operacion->getIdOperacion());
        $ayudantes=$query->getResult();

        $repository = $this->getDoctrine()->getRepository(OperacionModif::class);
        $em = $this->getDoctrine()->getManager();

        $catnmodif = count($repository->findBy(['operacionFk' => $operacion->getIdOperacion()]));
        $modificacion = $repository->findOneBy(
            ['operacionFk' => $operacion->getIdOperacion()],
            ['idOperacionModif' => 'DESC']
        );

        return $this->render('operacion/showPdf.html.twig', array(
            'operacion' => $operacion,
            'delete_form' => $deleteForm->createView(),
            'ayudantes' => $ayudantes,
            'cantmodif' => $catnmodif,
            'modificacion' => $modificacion,
        ));
    }

    /**
     * Finds and displays a operacion entity.
     *
     * @Route("original/{idOperacion}", name="operacionorig_show")
     * @Method("GET")
     */
    public function showOriginalAction(Operacion $operacion)
    {
        $deleteForm = $this->createDeleteForm($operacion);
//        $em = $this->getDoctrine()->getManager();

//        $entityManager = $this->getEntityManager();
        $entityManager = $this->getDoctrine()->getManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM AppBundle\Entity\AyudantesOperacion p
            WHERE p.operacionFk = :id'
        )->setParameter('id', $operacion->getIdOperacion());
        $ayudantes=$query->getResult();

        $repository = $this->getDoctrine()->getRepository(OperacionModif::class);
        $em = $this->getDoctrine()->getManager();

//        $catnmodif = count($repository->findBy(['operacionFk' => $operacion->getIdOperacion()]));
//        $modificacion = $repository->findOneBy(
//            ['operacionFk' => $operacion->getIdOperacion()],
//            ['idOperacionModif' => 'DESC']
//        );

        return $this->render('operacion/showOriginalPdf.html.twig', array(
            'operacion' => $operacion,
            'delete_form' => $deleteForm->createView(),
            'ayudantes' => $ayudantes,
//            'cantmodif' => $catnmodif,
//            'modificacion' => $modificacion,
        ));
    }

    /**
     * Displays a form to edit an existing operacion entity.
     *
     * @Route("/{idOperacion}/edit", name="operacion_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_MEDICO')")
     */
    public function editAction(Request $request, Operacion $operacion)
    {
        $user = $this->getUser();
        if($operacion->getCirujanoFk()->getNombre() != $user->getPersonalFk()->getNombre())
        {
            return $this->render('error/exception403.html.twig');
        }

        $deleteForm = $this->createDeleteForm($operacion);
        $editForm = $this->createForm('AppBundle\Form\OperacionType', $operacion);
        $editForm->handleRequest($request);

        //      Cargando todos los personales para los ayudantes
        $em = $this->getDoctrine()->getManager();
        $personals = $em->getRepository('AppBundle:Personal')->findAll();

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            if($operacion->getFechaInicio() > $operacion->getFechaFin()){
                $this->get('session')->getFlashBag()->set(
                    'danger',
                    array(
                        'title' => 'ERROR!',
                        'message' => 'La fecha de culminación de la operación no puede ser antes de la fecha de comienzo.'
                    ));
                return $this->redirect($this->generateUrl('operacion_edit',['idOperacion' => $operacion->getIdOperacion()]));
            }

            if($operacion->getHoraInicio() > $operacion->getHoraFin()){
                $this->get('session')->getFlashBag()->set(
                    'danger',
                    array(
                        'title' => 'ERROR!',
                        'message' => 'La hora de culminación de la operación no puede ser antes de la hora de comienzo.'
                    ));
                return $this->redirect($this->generateUrl('operacion_edit',['idOperacion' => $operacion->getIdOperacion()]));
            }

//            $this->getDoctrine()->getManager()->flush();
            $entityManager = $this->getDoctrine()->getManager();
            $modificada = $this->operAOperModif($operacion);
            $entityManager->persist($modificada);
            $entityManager->flush();

            //          Registrando en las trazas la edicion
            $traza = new Traza();
            $traza->setAccionRealizada('Se ha modificado una  operacion de folio '.$operacion->getFolio().' y de tipo '.$operacion->getOperacionRealizadaFk()->getNombre());
            $user = $this->getUser();
            $traza->setUsuarioFk($user);
            $fecha = getdate();
            $temp = new \DateTime();
            $temp->setDate($fecha['year'],$fecha['mon'],$fecha['mday']);
            $traza->setFecha($temp);
            $hora = new \DateTime();
            $hora->setTime(date("H"),date("i"),date("s"));
            $hora->format('H:i:s');
            $traza->setHora($hora);
            $em->persist($traza);
            $em->flush();

            $this->get('session')->getFlashBag()->set(
                'danger',
                array(
                    'title' => '',
                    'message' => 'Los datos de la operacion '.$operacion->getFolio().' se han actualizado satisfactoriamente.'
                ));
            return $this->redirectToRoute('operacion_show', array('idOperacion' => $operacion->getIdoperacion()));
        }

        return $this->render('operacion/edit.html.twig', array(
            'operacion' => $operacion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'personales'  => $personals,
        ));
    }

    /**
     * Deletes a operacion entity.
     *
     * @Route("/{idOperacion}", name="operacion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Operacion $operacion)
    {
        $form = $this->createDeleteForm($operacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($operacion);
            $em->flush();
        }

        return $this->redirectToRoute('operacion_index');
    }

    /**
     * Creates a form to delete a operacion entity.
     *
     * @param Operacion $operacion The operacion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Operacion $operacion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('operacion_delete', array('idOperacion' => $operacion->getIdoperacion())))
            ->setMethod('DELETE')
            ->getForm();
    }

//  Funcion para obtener el numero de la ultima operacion realizada en el anno del folio
    public function obtenerUOAnno()
    {
        $anno = '';
//        $total='';

//        $repository = $this->getDoctrine()->getRepository(Operacion::class);
//        $operacion = $repository->findOneBy(
//            ['idOperacion' => 'DESC']);

        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            'SELECT p
    FROM AppBundle:Operacion p
    ORDER BY p.idOperacion DESC'
        );
        $operacion = $query->setMaxResults(1)->getOneOrNullResult();

        $folio = $operacion->getFolio();

        for ($i = 0; $i < strlen($folio); $i++) {
            if ($folio[$i] == '-') {
                break;
            }
            $anno = $anno . $folio[$i];
//            echo "<br>".$folio[$i];
        }
        return intval($anno);
    }

    //  Funcion para obtener el numero de la ultima operacion realizada del folio
    public function obtenerUOTotal()
    {
//        $anno='';
        $total = '';
        $encontrado = false;

//        $repository = $this->getDoctrine()->getRepository(Operacion::class);
//        $operacion = $repository->findBy(
//            ['price' => 'ASC'],
//            ['limit' => '1']);

        $entityManager = $this->getDoctrine()->getManager();
        $query = $entityManager->createQuery(
            'SELECT p
    FROM AppBundle:Operacion p
    ORDER BY p.idOperacion DESC'
        );
        $operacion = $query->setMaxResults(1)->getOneOrNullResult();

        $folio = $operacion->getFolio();

        for ($i = 0; $i < strlen($folio); $i++) {
            if ($encontrado == true) {
                $total = $total . $folio[$i];
            }

            if ($folio[$i] == '-') {
                $encontrado = true;
            }
//            echo "<br>".$folio[$i];
        }
        return intval($total);
    }

//   funcione que devuelve el folio para la nueva operacion
    public function armarFolioNuevo()
    {
        $annoN = $this->obtenerUOAnno() + 1;
        $totalN = $this->obtenerUOTotal() + 1;

        if(date("z") == 0 ){
            return '1' . '-' . $totalN;
        }

        $folioNuevo = $annoN . '-' . $totalN;
        return $folioNuevo;

    }

    public function operAOperModif(Operacion $operacion)
    {
        $modificada = new OperacionModif();
        $modificada->setOperacionFk($operacion);
        $modificada->setPacienteFk($operacion->getPacienteFk());
        $modificada->setFolio($operacion->getFolio());
        $modificada->setEdadPaciente($operacion->getEdadPaciente());
        $modificada->setCirujanoFk($operacion->getCirujanoFk());
        $modificada->setAnestesistaFk($operacion->getAnestesistaFk());
        $modificada->setPrimerAyudanteFk($operacion->getAnestesistaFk());
        $modificada->setPerfusionistaFk($operacion->getPerfusionistaFk());
        $modificada->setClasifOperTipo1Fk($operacion->getClasifOperTipo1Fk());
        $modificada->setClasifOperTipo2Fk($operacion->getClasifOperTipo2Fk());
        $modificada->setClasifOperTipo3Fk($operacion->getClasifOperTipo3Fk());
        $modificada->setSalon($operacion->getSalon());
        $modificada->setCodificacionFk($operacion->getCodificacionFk());
        $modificada->setMetodoAnestesicoFk($operacion->getMetodoAnestesicoFk());
        $modificada->setAgenteAnestesicoFk($operacion->getAgenteAnestesicoFk());
        $modificada->setDiagnosticoClinicoFk($operacion->getDiagnosticoClinicoFk());
        $modificada->setOperacionRealizadaFk($operacion->getOperacionRealizadaFk());
        $modificada->setTipoProtesisFk($operacion->getTipoProtesisFk());
        $modificada->setReintervencion($operacion->getReintervencion());
        $modificada->setCirugiaCardiacaPrevia($operacion->getReintervencion());
        $modificada->setNumeroCirugiaPrevia($operacion->getNumeroCirugiaPrevia());
        $modificada->setDescripcionActoOperatorio($operacion->getDescripcionActoOperatorio());
        $modificada->setAccidentesOcurridos($operacion->getDescripcionActoOperatorio());
        $modificada->setPensamientoAortico($operacion->getPensamientoAortico());
        $modificada->setTparoAnoxico($operacion->getTparoAnoxico());
        $modificada->setTbypassTotal($operacion->getTbypassTotal());
        $modificada->setTbypassParcial($operacion->getTbypassParcial());
        $modificada->setTbypassApoyo($operacion->getTbypassApoyo());
        $modificada->setNoCardioplegias($operacion->getNoCardioplegias());
        $modificada->setTrm($operacion->getTrm());
        $modificada->setSuturasEmpleadas($operacion->getSuturasEmpleadas());
        $modificada->setDrenajes($operacion->getDrenajes());
        $modificada->setViaExteorizacionDrenaje($operacion->getViaExteorizacionDrenaje());
        $modificada->setOtrasOperaciones($operacion->getOtrasOperaciones());
        $modificada->setDiagnosticoOperatorio($operacion->getDiagnosticoOperatorio());
        $modificada->setPiezasEnviadasAp($operacion->getPiezasEnviadasAp());
        $modificada->setMuestrasEnviadasLab($operacion->getMuestrasEnviadasLab());
        $modificada->setTotalLiquidoAdministrado($operacion->getTotalLiquidoAdministrado());
        $modificada->setCantLiquidoAspirador($operacion->getCantLiquidoAspirador());
        $modificada->setSangre($operacion->getSangre());
        $modificada->setGlobulos($operacion->getGlobulos());
        $modificada->setPlasma($operacion->getPlasma());
        $modificada->setDextrosa($operacion->getDextrosa());
        $modificada->setElectrolitosDextran($operacion->getElectrolitosDextran());
        $modificada->setClna($operacion->getClna());
        $modificada->setCantCompresasG($operacion->getCantCompresasG());
        $modificada->setCantCompresasMc($operacion->getCantCompresasMc());
        $modificada->setCantCompresasCh($operacion->getCantCompresasCh());
        $modificada->setEstadoSalirSalonFk($operacion->getEstadoSalirSalonFk());
        $modificada->setTiempoQuirurgico($operacion->getTiempoQuirurgico());
        $modificada->setPulso($operacion->getPulso());
        $modificada->setTensionArterial($operacion->getTensionArterial());
        $modificada->setRespiracionFk($operacion->getRespiracionFk());
        $modificada->setReflejosFk($operacion->getReflejosFk());
        $modificada->setEnfermeraFk($operacion->getEnfermeraFk());
        $modificada->setFechaInicio($operacion->getFechaInicio());
        $modificada->setFechaFin($operacion->getFechaFin());
        $modificada->setHoraInicio($operacion->getHoraInicio());
        $modificada->setHoraFin($operacion->getHoraFin());
        $modificada->setSalaFk($operacion->getSalaFk());
        $modificada->setCama($operacion->getCama());
        $modificada->setMedicoAsistenciaFk($operacion->getMedicoAsistenciaFk());
        $modificada->setFechaElaboracion($operacion->getFechaElaboracion());
        $modificada->setInstrumentalCompleto($operacion->getInstrumentalCompleto());
        return $modificada;

    }

    /**
     * Finds and displays a operacion entity.
     *
     * @Route("/{idOperacion}", name="pdf")
     * @Method("GET")
     */
    public function operacionPDF($id)
    {
        $em = $this->getDoctrine()->getManager();
        $operacion = $em->getRepository('AppBundle:Operacion')->find($id);

        $entityManager = $this->getDoctrine()->getManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM AppBundle\Entity\AyudantesOperacion p
            WHERE p.operacionFk = :id'
        )->setParameter('id', $operacion->getIdOperacion());
        $ayudantes=$query->getResult();

        return $this->getPdfExporter()->attach('InformeOperatorio.html.twig',
            array('operacion' => $operacion,
                'ayudantes' => $ayudantes),
            "Reportes de Miembros de proyectos", // titulo del pdf
            "Letter" // tipo de papel "Letter", "A4", etc.

        );
    }

    /**
     * Muestra el pdf
     *
     * @Route("/{idOperacion}/pdfview", name="pdf_view")
     * @Method({"GET"})
     */
    public function operacionPDFView(Operacion $operacion)
    {
        $em = $this->getDoctrine()->getManager();

//        $operacion = $em->getRepository('AppBundle:Operacion')->find($operacion->getIdOperacion());

        $entityManager = $this->getDoctrine()->getManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM AppBundle\Entity\AyudantesOperacion p
            WHERE p.operacionFk = :id'
        )->setParameter('id', $operacion->getIdOperacion());
        $ayudantes=$query->getResult();


        return $this->getPdfExporter()->render('InformeOperatorio.html.twig',
            array('operacion' => $operacion,
                'ayudantes' => $ayudantes)
        );
    }

    /**
     * @return \Gestor\PdfBundle\Exporter\PdfExporter
     */
    public function getPdfExporter() {
        return $this->container->get("gestor.exporter.pdf");
    }

}
