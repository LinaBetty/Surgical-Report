<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Pacientes;
use AppBundle\Entity\Traza;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * Paciente controller.
 *
 * @Route("pacientes")
 */
class PacientesController extends Controller
{
    /**
     * Lists all paciente entities.
     *
     * @Route("/", name="pacientes_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pacientes = $em->getRepository('AppBundle:Pacientes')->findAll();

        return $this->render('pacientes/index.html.twig', array(
            'pacientes' => $pacientes,
        ));
    }

    /**
     * Creates a new paciente entity.
     *
     * @Route("/new", name="pacientes_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_MEDICO')")
     */
    public function newAction(Request $request)
    {
        $paciente = new Pacientes();
        $form = $this->createForm('AppBundle\Form\PacientesType', $paciente);
        $form->handleRequest($request);

        //          Validando entreda de un paciente repetido
        $repository = $this->getDoctrine()->getRepository(Pacientes::class);
        $pacienteRepetido = $repository->findOneBy([
            'nombre' => $paciente->getNombre(),
            'primerApellido' => $paciente->getPrimerApellido(),
            'segundoApellido' => $paciente->getSegundoApellido(),
        ]);
        $ciRepetido = $repository->findOneBy([
            'ci' => $paciente->getCi(),
        ]);

        if ($pacienteRepetido != null or $ciRepetido!=null) {
//            $form->addError(new FormError('ERROR! El paciente ya existe.'));
            $this->get('session')->getFlashBag()->set(
                'danger',
                array(
                    'title' => 'ERROR!',
                    'message' => 'Ya existe este paciente'
                ));
            return $this->redirect($this->generateUrl('pacientes_new'));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($paciente);
            $em->flush();

//          Registrando en las trazas la insercion
            $traza = new Traza();
            $traza->setAccionRealizada('Se ha insertado un nuevo paciente de nombre '.$paciente->getNombre().' '.$paciente->getPrimerApellido().' '.$paciente->getSegundoApellido().' y CI '.$paciente->getCi());
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
                    'message' => 'Se ha registrado al paciente '.$paciente->nombreCompleto().' satisfactoriamente.'
                ));
            return $this->redirectToRoute('pacientes_show', array('idPacientes' => $paciente->getIdpacientes()));
        }

        return $this->render('pacientes/new.html.twig', array(
            'paciente' => $paciente,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a paciente entity.
     *
     * @Route("/{idPacientes}", name="pacientes_show")
     * @Method("GET")
     */
    public function showAction(Pacientes $paciente)
    {
        $deleteForm = $this->createDeleteForm($paciente);

        return $this->render('pacientes/show.html.twig', array(
            'paciente' => $paciente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing paciente entity.
     *
     * @Route("/{idPacientes}/edit", name="pacientes_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_MEDICO')")
     */
    public function editAction(Request $request, Pacientes $paciente)
    {
        $deleteForm = $this->createDeleteForm($paciente);
        $editForm = $this->createForm('AppBundle\Form\PacientesType', $paciente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            //          Registrando en las trazas la edicion
            $em = $this->getDoctrine()->getManager();
            $traza = new Traza();
            $traza->setAccionRealizada('Se han modificado los datos de un paciente de nombre '.$paciente->getNombre().' '.$paciente->getPrimerApellido().' '.$paciente->getSegundoApellido().' y CI '.$paciente->getCi());
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
                    'message' => 'Se han actualizado los datos del paciente '.$paciente->nombreCompleto().' satisfactoriamente.'
                ));
            return $this->redirectToRoute('pacientes_show', array('idPacientes' => $paciente->getIdpacientes()));
        }

        return $this->render('pacientes/edit.html.twig', array(
            'paciente' => $paciente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a paciente entity.
     *
     * @Route("/{idPacientes}", name="pacientes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pacientes $paciente)
    {
        $form = $this->createDeleteForm($paciente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($paciente);
            $em->flush();
        }

        return $this->redirectToRoute('pacientes_index');
    }

    /**
     * Creates a form to delete a paciente entity.
     *
     * @param Pacientes $paciente The paciente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pacientes $paciente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pacientes_delete', array('idPacientes' => $paciente->getIdpacientes())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
