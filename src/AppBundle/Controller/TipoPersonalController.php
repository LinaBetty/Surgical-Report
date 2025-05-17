<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TipoPersonal;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Tipopersonal controller.
 *
 * @Route("tipopersonal")
 */
class TipoPersonalController extends Controller
{
    /**
     * Lists all tipoPersonal entities.
     *
     * @Route("/", name="tipopersonal_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tipoPersonals = $em->getRepository('AppBundle:TipoPersonal')->findAll();

        return $this->render('tipopersonal/index.html.twig', array(
            'tipoPersonals' => $tipoPersonals,
        ));
    }

    /**
     * Creates a new tipoPersonal entity.
     *
     * @Route("/new", name="tipopersonal_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tipoPersonal = new Tipopersonal();
        $form = $this->createForm('AppBundle\Form\TipoPersonalType', $tipoPersonal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipoPersonal);
            $em->flush();

            return $this->redirectToRoute('tipopersonal_show', array('idTipoPersonal' => $tipoPersonal->getIdtipopersonal()));
        }

        return $this->render('tipopersonal/new.html.twig', array(
            'tipoPersonal' => $tipoPersonal,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tipoPersonal entity.
     *
     * @Route("/{idTipoPersonal}", name="tipopersonal_show")
     * @Method("GET")
     */
    public function showAction(TipoPersonal $tipoPersonal)
    {
        $deleteForm = $this->createDeleteForm($tipoPersonal);

        return $this->render('tipopersonal/show.html.twig', array(
            'tipoPersonal' => $tipoPersonal,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tipoPersonal entity.
     *
     * @Route("/{idTipoPersonal}/edit", name="tipopersonal_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TipoPersonal $tipoPersonal)
    {
        $deleteForm = $this->createDeleteForm($tipoPersonal);
        $editForm = $this->createForm('AppBundle\Form\TipoPersonalType', $tipoPersonal);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tipopersonal_edit', array('idTipoPersonal' => $tipoPersonal->getIdtipopersonal()));
        }

        return $this->render('tipopersonal/edit.html.twig', array(
            'tipoPersonal' => $tipoPersonal,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tipoPersonal entity.
     *
     * @Route("/{idTipoPersonal}", name="tipopersonal_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TipoPersonal $tipoPersonal)
    {
        $form = $this->createDeleteForm($tipoPersonal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tipoPersonal);
            $em->flush();
        }

        return $this->redirectToRoute('tipopersonal_index');
    }

    /**
     * Creates a form to delete a tipoPersonal entity.
     *
     * @param TipoPersonal $tipoPersonal The tipoPersonal entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TipoPersonal $tipoPersonal)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipopersonal_delete', array('idTipoPersonal' => $tipoPersonal->getIdtipopersonal())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
