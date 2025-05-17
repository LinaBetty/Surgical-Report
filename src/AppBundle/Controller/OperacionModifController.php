<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Operacion;
use AppBundle\Entity\OperacionModif;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Operacionmodif controller.
 *
 * @Route("operacionmodif")
 */
class OperacionModifController extends Controller
{
    /**
     * Lists all operacionModif entities.
     *
     * @Route("/", name="operacionmodif_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $operacionModifs = $em->getRepository('AppBundle:OperacionModif')->findAll();

        return $this->render('operacionmodif/index.html.twig', array(
            'operacionModifs' => $operacionModifs,
        ));
    }

    /**
     * Creates a new operacionModif entity.
     *
     * @Route("/{idOperacion}/new", name="operacionmodif_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Operacion $operacion)
    {
        $user = $this->getUser();
        if($user->getPersonalFk()->getNombre() != $operacion->getCirujanoFk()->getNombre())
        {
            return $this->render('error/exception403.html.twig');
        }
        $operacionModif = new Operacionmodif();
        $operacionModif = $this->operAOperModif($operacion);
        $operacionModif->setOperacionFk($operacion);
        $fecha = getdate();
        $temp = new \DateTime();
        $temp->setDate($fecha['year'],$fecha['mon'],$fecha['mday']);
        $operacionModif->setFechaModif($temp);

        $form = $this->createForm('AppBundle\Form\OperacionModifType', $operacionModif);
        $form->handleRequest($request);

        //      Cargando todos los personales para los ayudantes
        $em = $this->getDoctrine()->getManager();
        $personals = $em->getRepository('AppBundle:Personal')->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($operacionModif);
            $em->flush();

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

            return $this->redirectToRoute('operacion_show', array('idOperacion' => $operacion->getIdOperacion()));
        }

        return $this->render('operacionmodif/new.html.twig', array(
            'operacionModif' => $operacionModif,
            'form' => $form->createView(),
            'operacion' => $operacion,
            'personales' => $personals,
        ));
    }

    /**
     * Finds and displays a operacionModif entity.
     *
     * @Route("/{idOperacionModif}", name="operacionmodif_show")
     * @Method("GET")
     */
    public function showAction(OperacionModif $operacionModif)
    {
        $deleteForm = $this->createDeleteForm($operacionModif);

        return $this->render('operacionmodif/show.html.twig', array(
            'operacionModif' => $operacionModif,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing operacionModif entity.
     *
     * @Route("/{idOperacionModif}/edit", name="operacionmodif_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, OperacionModif $operacionModif)
    {
        $deleteForm = $this->createDeleteForm($operacionModif);
        $editForm = $this->createForm('AppBundle\Form\OperacionModifType', $operacionModif);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('operacionmodif_edit', array('idOperacionModif' => $operacionModif->getIdoperacionmodif()));
        }

        return $this->render('operacionmodif/edit.html.twig', array(
            'operacionModif' => $operacionModif,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a operacionModif entity.
     *
     * @Route("/{idOperacionModif}", name="operacionmodif_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, OperacionModif $operacionModif)
    {
        $form = $this->createDeleteForm($operacionModif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($operacionModif);
            $em->flush();
        }

        return $this->redirectToRoute('operacionmodif_index');
    }

    /**
     * Creates a form to delete a operacionModif entity.
     *
     * @param OperacionModif $operacionModif The operacionModif entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(OperacionModif $operacionModif)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('operacionmodif_delete', array('idOperacionModif' => $operacionModif->getIdoperacionmodif())))
            ->setMethod('DELETE')
            ->getForm()
        ;
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

}
