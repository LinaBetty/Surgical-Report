<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TipoProtesis;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Tipoprotesi controller.
 *
 * @Route("tipoprotesis")
 */
class TipoProtesisController extends Controller
{
    /**
     * Lists all tipoProtesi entities.
     *
     * @Route("/", name="tipoprotesis_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tipoProteses = $em->getRepository('AppBundle:TipoProtesis')->findAll();

        return $this->render('tipoprotesis/index.html.twig', array(
            'tipoProteses' => $tipoProteses,
        ));
    }

    /**
     * Creates a new tipoProtesi entity.
     *
     * @Route("/new", name="tipoprotesis_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tipoProtesi = new Tipoprotesi();
        $form = $this->createForm('AppBundle\Form\TipoProtesisType', $tipoProtesi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipoProtesi);
            $em->flush();

            return $this->redirectToRoute('tipoprotesis_show', array('idTipoProtesis' => $tipoProtesi->getIdtipoprotesis()));
        }

        return $this->render('tipoprotesis/new.html.twig', array(
            'tipoProtesi' => $tipoProtesi,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tipoProtesi entity.
     *
     * @Route("/{idTipoProtesis}", name="tipoprotesis_show")
     * @Method("GET")
     */
    public function showAction(TipoProtesis $tipoProtesi)
    {
        $deleteForm = $this->createDeleteForm($tipoProtesi);

        return $this->render('tipoprotesis/show.html.twig', array(
            'tipoProtesi' => $tipoProtesi,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tipoProtesi entity.
     *
     * @Route("/{idTipoProtesis}/edit", name="tipoprotesis_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TipoProtesis $tipoProtesi)
    {
        $deleteForm = $this->createDeleteForm($tipoProtesi);
        $editForm = $this->createForm('AppBundle\Form\TipoProtesisType', $tipoProtesi);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tipoprotesis_edit', array('idTipoProtesis' => $tipoProtesi->getIdtipoprotesis()));
        }

        return $this->render('tipoprotesis/edit.html.twig', array(
            'tipoProtesi' => $tipoProtesi,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tipoProtesi entity.
     *
     * @Route("/{idTipoProtesis}", name="tipoprotesis_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TipoProtesis $tipoProtesi)
    {
        $form = $this->createDeleteForm($tipoProtesi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tipoProtesi);
            $em->flush();
        }

        return $this->redirectToRoute('tipoprotesis_index');
    }

    /**
     * Creates a form to delete a tipoProtesi entity.
     *
     * @param TipoProtesis $tipoProtesi The tipoProtesi entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TipoProtesis $tipoProtesi)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipoprotesis_delete', array('idTipoProtesis' => $tipoProtesi->getIdtipoprotesis())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
