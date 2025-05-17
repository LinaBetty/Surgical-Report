<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Personal;
use AppBundle\Entity\Traza;
use AppBundle\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Personal controller.
 *
 * @Route("personal")
 */
class PersonalController extends Controller
{
    /**
     * Lists all personal entities.
     *
     * @Route("/", name="personal_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $personals = $em->getRepository('AppBundle:Personal')->findAll();

        return $this->render('personal/index.html.twig', array(
            'personals' => $personals,
        ));
    }

    /**
     * Creates a new personal entity.
     *
     * @Route("/new", name="personal_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $personal = new Personal();
        $form = $this->createForm('AppBundle\Form\PersonalType', $personal);
        $form->handleRequest($request);

        //          Validando entreda de un paciente repetido
        $repository = $this->getDoctrine()->getRepository(Personal::class);
        $pacienteRepetido = $repository->findOneBy([
            'nombre' => $personal->getNombre(),
        ]);
        $ciRepetido = $repository->findOneBy([
            'registroProfesional' => $personal->getRegistroProfesional(),
        ]);

        if ($pacienteRepetido != null or $ciRepetido!=null) {
//            $form->addError(new FormError('ERROR! El paciente ya existe.'));
            $this->get('session')->getFlashBag()->set(
                'danger',
                array(
                    'title' => 'ERROR!',
                    'message' => 'Ya existe este personal'
                ));
            return $this->redirect($this->generateUrl('personal_new'));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($personal);
            $em->flush();

            //          Registrando en las trazas la insercion
            $traza = new Traza();
            $traza->setAccionRealizada('Se ha insertado un nuevo personal de nombre '.$personal->getNombre().' y Registro Profesional '.$personal->getRegistroProfesional());
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
                    'message' => 'El trabajador '. $personal->getNombre().' ha sido registrado satisfactoriamente.'
                ));
            return $this->redirectToRoute('personal_show', array('idPersonal' => $personal->getIdpersonal()));
        }

        return $this->render('personal/new.html.twig', array(
            'personal' => $personal,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a personal entity.
     *
     * @Route("/{idPersonal}", name="personal_show")
     * @Method("GET")
     */
    public function showAction(Personal $personal)
    {
        $deleteForm = $this->createDeleteForm($personal);

        return $this->render('personal/show.html.twig', array(
            'personal' => $personal,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing personal entity.
     *
     * @Route("/{idPersonal}/edit", name="personal_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, Personal $personal)
    {
        $deleteForm = $this->createDeleteForm($personal);
        $editForm = $this->createForm('AppBundle\Form\PersonalType', $personal);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $em = $this->getDoctrine()->getManager();
            //          Registrando en las trazas la edicion
            $traza = new Traza();
            $traza->setAccionRealizada('Se han modificado los datos de un trabajador de nombre '.$personal->getNombre().' y Registro Profesional '.$personal->getRegistroProfesional());
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
                    'message' => 'Los datos del trabajador '. $personal->getNombre().' han sido actualizados satisfactoriamente.'
                ));
            return $this->redirectToRoute('personal_show', array('idPersonal' => $personal->getIdpersonal()));
        }

        return $this->render('personal/edit.html.twig', array(
            'personal' => $personal,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a personal entity.
     *
     * @Route("/{idPersonal}", name="personal_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Personal $personal)
    {
        $form = $this->createDeleteForm($personal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($personal);
            $em->flush();
        }

        return $this->redirectToRoute('personal_index');
    }

    /**
     * Creates a form to delete a personal entity.
     *
     * @param Personal $personal The personal entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Personal $personal)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('personal_delete', array('idPersonal' => $personal->getIdpersonal())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
