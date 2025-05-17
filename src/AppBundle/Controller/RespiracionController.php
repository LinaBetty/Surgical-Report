<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Respiracion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Respiracion controller.
 *
 * @Route("respiracion")
 */
class RespiracionController extends Controller
{
    /**
     * Lists all respiracion entities.
     *
     * @Route("/", name="respiracion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $respiracions = $em->getRepository('AppBundle:Respiracion')->findAll();

        return $this->render('respiracion/index.html.twig', array(
            'respiracions' => $respiracions,
        ));
    }

    /**
     * Creates a new respiracion entity.
     *
     * @Route("/new", name="respiracion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $respiracion = new Respiracion();
        $form = $this->createForm('AppBundle\Form\RespiracionType', $respiracion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($respiracion);
            $em->flush();

            return $this->redirectToRoute('respiracion_show', array('idRespiracion' => $respiracion->getIdrespiracion()));
        }

        return $this->render('respiracion/new.html.twig', array(
            'respiracion' => $respiracion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a respiracion entity.
     *
     * @Route("/{idRespiracion}", name="respiracion_show")
     * @Method("GET")
     */
    public function showAction(Respiracion $respiracion)
    {
        $deleteForm = $this->createDeleteForm($respiracion);

        return $this->render('respiracion/show.html.twig', array(
            'respiracion' => $respiracion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing respiracion entity.
     *
     * @Route("/{idRespiracion}/edit", name="respiracion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Respiracion $respiracion)
    {
        $deleteForm = $this->createDeleteForm($respiracion);
        $editForm = $this->createForm('AppBundle\Form\RespiracionType', $respiracion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('respiracion_edit', array('idRespiracion' => $respiracion->getIdrespiracion()));
        }

        return $this->render('respiracion/edit.html.twig', array(
            'respiracion' => $respiracion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a respiracion entity.
     *
     * @Route("/{idRespiracion}", name="respiracion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Respiracion $respiracion)
    {
        $form = $this->createDeleteForm($respiracion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($respiracion);
            $em->flush();
        }

        return $this->redirectToRoute('respiracion_index');
    }

    /**
     * Creates a form to delete a respiracion entity.
     *
     * @param Respiracion $respiracion The respiracion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Respiracion $respiracion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('respiracion_delete', array('idRespiracion' => $respiracion->getIdrespiracion())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
