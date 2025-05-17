<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EstadoCivil;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Estadocivil controller.
 *
 * @Route("estadocivil")
 */
class EstadoCivilController extends Controller
{
    /**
     * Lists all estadoCivil entities.
     *
     * @Route("/", name="estadocivil_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $estadoCivils = $em->getRepository('AppBundle:EstadoCivil')->findAll();

        return $this->render('estadocivil/index.html.twig', array(
            'estadoCivils' => $estadoCivils,
        ));
    }

    /**
     * Creates a new estadoCivil entity.
     *
     * @Route("/new", name="estadocivil_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $estadoCivil = new Estadocivil();
        $form = $this->createForm('AppBundle\Form\EstadoCivilType', $estadoCivil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($estadoCivil);
            $em->flush();

            return $this->redirectToRoute('estadocivil_show', array('idEstadoCivil' => $estadoCivil->getIdestadocivil()));
        }

        return $this->render('estadocivil/new.html.twig', array(
            'estadoCivil' => $estadoCivil,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a estadoCivil entity.
     *
     * @Route("/{idEstadoCivil}", name="estadocivil_show")
     * @Method("GET")
     */
    public function showAction(EstadoCivil $estadoCivil)
    {
        $deleteForm = $this->createDeleteForm($estadoCivil);

        return $this->render('estadocivil/show.html.twig', array(
            'estadoCivil' => $estadoCivil,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing estadoCivil entity.
     *
     * @Route("/{idEstadoCivil}/edit", name="estadocivil_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EstadoCivil $estadoCivil)
    {
        $deleteForm = $this->createDeleteForm($estadoCivil);
        $editForm = $this->createForm('AppBundle\Form\EstadoCivilType', $estadoCivil);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('estadocivil_edit', array('idEstadoCivil' => $estadoCivil->getIdestadocivil()));
        }

        return $this->render('estadocivil/edit.html.twig', array(
            'estadoCivil' => $estadoCivil,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a estadoCivil entity.
     *
     * @Route("/{idEstadoCivil}", name="estadocivil_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, EstadoCivil $estadoCivil)
    {
        $form = $this->createDeleteForm($estadoCivil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($estadoCivil);
            $em->flush();
        }

        return $this->redirectToRoute('estadocivil_index');
    }

    /**
     * Creates a form to delete a estadoCivil entity.
     *
     * @param EstadoCivil $estadoCivil The estadoCivil entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(EstadoCivil $estadoCivil)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('estadocivil_delete', array('idEstadoCivil' => $estadoCivil->getIdestadocivil())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
