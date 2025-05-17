<?php

namespace AppBundle\Controller;

use AppBundle\Entity\OperacionRealizada;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Operacionrealizada controller.
 *
 * @Route("operacionrealizada")
 */
class OperacionRealizadaController extends Controller
{
    /**
     * Lists all operacionRealizada entities.
     *
     * @Route("/", name="operacionrealizada_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $operacionRealizadas = $em->getRepository('AppBundle:OperacionRealizada')->findAll();

        return $this->render('operacionrealizada/index.html.twig', array(
            'operacionRealizadas' => $operacionRealizadas,
        ));
    }

    /**
     * Creates a new operacionRealizada entity.
     *
     * @Route("/new", name="operacionrealizada_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $operacionRealizada = new Operacionrealizada();
        $form = $this->createForm('AppBundle\Form\OperacionRealizadaType', $operacionRealizada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($operacionRealizada);
            $em->flush();

            return $this->redirectToRoute('operacionrealizada_show', array('idOperacionRealizada' => $operacionRealizada->getIdoperacionrealizada()));
        }

        return $this->render('operacionrealizada/new.html.twig', array(
            'operacionRealizada' => $operacionRealizada,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a operacionRealizada entity.
     *
     * @Route("/{idOperacionRealizada}", name="operacionrealizada_show")
     * @Method("GET")
     */
    public function showAction(OperacionRealizada $operacionRealizada)
    {
        $deleteForm = $this->createDeleteForm($operacionRealizada);

        return $this->render('operacionrealizada/show.html.twig', array(
            'operacionRealizada' => $operacionRealizada,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing operacionRealizada entity.
     *
     * @Route("/{idOperacionRealizada}/edit", name="operacionrealizada_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, OperacionRealizada $operacionRealizada)
    {
        $deleteForm = $this->createDeleteForm($operacionRealizada);
        $editForm = $this->createForm('AppBundle\Form\OperacionRealizadaType', $operacionRealizada);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('operacionrealizada_edit', array('idOperacionRealizada' => $operacionRealizada->getIdoperacionrealizada()));
        }

        return $this->render('operacionrealizada/edit.html.twig', array(
            'operacionRealizada' => $operacionRealizada,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a operacionRealizada entity.
     *
     * @Route("/{idOperacionRealizada}", name="operacionrealizada_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, OperacionRealizada $operacionRealizada)
    {
        $form = $this->createDeleteForm($operacionRealizada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($operacionRealizada);
            $em->flush();
        }

        return $this->redirectToRoute('operacionrealizada_index');
    }

    /**
     * Creates a form to delete a operacionRealizada entity.
     *
     * @param OperacionRealizada $operacionRealizada The operacionRealizada entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(OperacionRealizada $operacionRealizada)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('operacionrealizada_delete', array('idOperacionRealizada' => $operacionRealizada->getIdoperacionrealizada())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
