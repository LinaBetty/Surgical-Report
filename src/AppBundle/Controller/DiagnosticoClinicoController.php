<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DiagnosticoClinico;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Diagnosticoclinico controller.
 *
 * @Route("diagnosticoclinico")
 */
class DiagnosticoClinicoController extends Controller
{
    /**
     * Lists all diagnosticoClinico entities.
     *
     * @Route("/", name="diagnosticoclinico_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $diagnosticoClinicos = $em->getRepository('AppBundle:DiagnosticoClinico')->findAll();

        return $this->render('diagnosticoclinico/index.html.twig', array(
            'diagnosticoClinicos' => $diagnosticoClinicos,
        ));
    }

    /**
     * Creates a new diagnosticoClinico entity.
     *
     * @Route("/new", name="diagnosticoclinico_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $diagnosticoClinico = new Diagnosticoclinico();
        $form = $this->createForm('AppBundle\Form\DiagnosticoClinicoType', $diagnosticoClinico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($diagnosticoClinico);
            $em->flush();

            return $this->redirectToRoute('diagnosticoclinico_show', array('idDiagnosticoClinico' => $diagnosticoClinico->getIddiagnosticoclinico()));
        }

        return $this->render('diagnosticoclinico/new.html.twig', array(
            'diagnosticoClinico' => $diagnosticoClinico,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a diagnosticoClinico entity.
     *
     * @Route("/{idDiagnosticoClinico}", name="diagnosticoclinico_show")
     * @Method("GET")
     */
    public function showAction(DiagnosticoClinico $diagnosticoClinico)
    {
        $deleteForm = $this->createDeleteForm($diagnosticoClinico);

        return $this->render('diagnosticoclinico/show.html.twig', array(
            'diagnosticoClinico' => $diagnosticoClinico,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing diagnosticoClinico entity.
     *
     * @Route("/{idDiagnosticoClinico}/edit", name="diagnosticoclinico_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, DiagnosticoClinico $diagnosticoClinico)
    {
        $deleteForm = $this->createDeleteForm($diagnosticoClinico);
        $editForm = $this->createForm('AppBundle\Form\DiagnosticoClinicoType', $diagnosticoClinico);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('diagnosticoclinico_edit', array('idDiagnosticoClinico' => $diagnosticoClinico->getIddiagnosticoclinico()));
        }

        return $this->render('diagnosticoclinico/edit.html.twig', array(
            'diagnosticoClinico' => $diagnosticoClinico,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a diagnosticoClinico entity.
     *
     * @Route("/{idDiagnosticoClinico}", name="diagnosticoclinico_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, DiagnosticoClinico $diagnosticoClinico)
    {
        $form = $this->createDeleteForm($diagnosticoClinico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($diagnosticoClinico);
            $em->flush();
        }

        return $this->redirectToRoute('diagnosticoclinico_index');
    }

    /**
     * Creates a form to delete a diagnosticoClinico entity.
     *
     * @param DiagnosticoClinico $diagnosticoClinico The diagnosticoClinico entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DiagnosticoClinico $diagnosticoClinico)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('diagnosticoclinico_delete', array('idDiagnosticoClinico' => $diagnosticoClinico->getIddiagnosticoclinico())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
