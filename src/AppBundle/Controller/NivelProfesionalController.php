<?php

namespace AppBundle\Controller;

use AppBundle\Entity\NivelProfesional;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Nivelprofesional controller.
 *
 * @Route("nivelprofesional")
 */
class NivelProfesionalController extends Controller
{
    /**
     * Lists all nivelProfesional entities.
     *
     * @Route("/", name="nivelprofesional_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $nivelProfesionals = $em->getRepository('AppBundle:NivelProfesional')->findAll();

        return $this->render('nivelprofesional/index.html.twig', array(
            'nivelProfesionals' => $nivelProfesionals,
        ));
    }

    /**
     * Creates a new nivelProfesional entity.
     *
     * @Route("/new", name="nivelprofesional_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $nivelProfesional = new Nivelprofesional();
        $form = $this->createForm('AppBundle\Form\NivelProfesionalType', $nivelProfesional);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($nivelProfesional);
            $em->flush();

            return $this->redirectToRoute('nivelprofesional_show', array('nivelProfesionalId' => $nivelProfesional->getNivelprofesionalid()));
        }

        return $this->render('nivelprofesional/new.html.twig', array(
            'nivelProfesional' => $nivelProfesional,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a nivelProfesional entity.
     *
     * @Route("/{nivelProfesionalId}", name="nivelprofesional_show")
     * @Method("GET")
     */
    public function showAction(NivelProfesional $nivelProfesional)
    {
        $deleteForm = $this->createDeleteForm($nivelProfesional);

        return $this->render('nivelprofesional/show.html.twig', array(
            'nivelProfesional' => $nivelProfesional,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing nivelProfesional entity.
     *
     * @Route("/{nivelProfesionalId}/edit", name="nivelprofesional_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, NivelProfesional $nivelProfesional)
    {
        $deleteForm = $this->createDeleteForm($nivelProfesional);
        $editForm = $this->createForm('AppBundle\Form\NivelProfesionalType', $nivelProfesional);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('nivelprofesional_edit', array('nivelProfesionalId' => $nivelProfesional->getNivelprofesionalid()));
        }

        return $this->render('nivelprofesional/edit.html.twig', array(
            'nivelProfesional' => $nivelProfesional,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a nivelProfesional entity.
     *
     * @Route("/{nivelProfesionalId}", name="nivelprofesional_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, NivelProfesional $nivelProfesional)
    {
        $form = $this->createDeleteForm($nivelProfesional);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($nivelProfesional);
            $em->flush();
        }

        return $this->redirectToRoute('nivelprofesional_index');
    }

    /**
     * Creates a form to delete a nivelProfesional entity.
     *
     * @param NivelProfesional $nivelProfesional The nivelProfesional entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(NivelProfesional $nivelProfesional)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('nivelprofesional_delete', array('nivelProfesionalId' => $nivelProfesional->getNivelprofesionalid())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
