<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AyudantesOperacion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Ayudantesoperacion controller.
 *
 * @Route("ayudantesoperacion")
 */
class AyudantesOperacionController extends Controller
{
    /**
     * Lists all ayudantesOperacion entities.
     *
     * @Route("/", name="ayudantesoperacion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ayudantesOperacions = $em->getRepository('AppBundle:AyudantesOperacion')->findAll();

        return $this->render('ayudantesoperacion/index.html.twig', array(
            'ayudantesOperacions' => $ayudantesOperacions,
        ));
    }

    /**
     * Creates a new ayudantesOperacion entity.
     *
     * @Route("/new", name="ayudantesoperacion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ayudantesOperacion = new Ayudantesoperacion();
        $form = $this->createForm('AppBundle\Form\AyudantesOperacionType', $ayudantesOperacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ayudantesOperacion);
            $em->flush();

            return $this->redirectToRoute('ayudantesoperacion_show', array('idAyudantesOperacion' => $ayudantesOperacion->getIdayudantesoperacion()));
        }

        return $this->render('ayudantesoperacion/new.html.twig', array(
            'ayudantesOperacion' => $ayudantesOperacion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ayudantesOperacion entity.
     *
     * @Route("/{idAyudantesOperacion}", name="ayudantesoperacion_show")
     * @Method("GET")
     */
    public function showAction(AyudantesOperacion $ayudantesOperacion)
    {
        $deleteForm = $this->createDeleteForm($ayudantesOperacion);

        return $this->render('ayudantesoperacion/show.html.twig', array(
            'ayudantesOperacion' => $ayudantesOperacion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ayudantesOperacion entity.
     *
     * @Route("/{idAyudantesOperacion}/edit", name="ayudantesoperacion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AyudantesOperacion $ayudantesOperacion)
    {
        $deleteForm = $this->createDeleteForm($ayudantesOperacion);
        $editForm = $this->createForm('AppBundle\Form\AyudantesOperacionType', $ayudantesOperacion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ayudantesoperacion_edit', array('idAyudantesOperacion' => $ayudantesOperacion->getIdayudantesoperacion()));
        }

        return $this->render('ayudantesoperacion/edit.html.twig', array(
            'ayudantesOperacion' => $ayudantesOperacion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ayudantesOperacion entity.
     *
     * @Route("/{idAyudantesOperacion}", name="ayudantesoperacion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AyudantesOperacion $ayudantesOperacion)
    {
        $form = $this->createDeleteForm($ayudantesOperacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ayudantesOperacion);
            $em->flush();
        }

        return $this->redirectToRoute('ayudantesoperacion_index');
    }

    /**
     * Creates a form to delete a ayudantesOperacion entity.
     *
     * @param AyudantesOperacion $ayudantesOperacion The ayudantesOperacion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AyudantesOperacion $ayudantesOperacion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ayudantesoperacion_delete', array('idAyudantesOperacion' => $ayudantesOperacion->getIdayudantesoperacion())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
