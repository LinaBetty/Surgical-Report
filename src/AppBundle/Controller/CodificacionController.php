<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Codificacion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Codificacion controller.
 *
 * @Route("codificacion")
 */
class CodificacionController extends Controller
{
    /**
     * Lists all codificacion entities.
     *
     * @Route("/", name="codificacion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $codificacions = $em->getRepository('AppBundle:Codificacion')->findAll();

        return $this->render('codificacion/index.html.twig', array(
            'codificacions' => $codificacions,
        ));
    }

    /**
     * Creates a new codificacion entity.
     *
     * @Route("/new", name="codificacion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $codificacion = new Codificacion();
        $form = $this->createForm('AppBundle\Form\CodificacionType', $codificacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($codificacion);
            $em->flush();

            return $this->redirectToRoute('codificacion_show', array('idCodificacion' => $codificacion->getIdcodificacion()));
        }

        return $this->render('codificacion/new.html.twig', array(
            'codificacion' => $codificacion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a codificacion entity.
     *
     * @Route("/{idCodificacion}", name="codificacion_show")
     * @Method("GET")
     */
    public function showAction(Codificacion $codificacion)
    {
        $deleteForm = $this->createDeleteForm($codificacion);

        return $this->render('codificacion/show.html.twig', array(
            'codificacion' => $codificacion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing codificacion entity.
     *
     * @Route("/{idCodificacion}/edit", name="codificacion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Codificacion $codificacion)
    {
        $deleteForm = $this->createDeleteForm($codificacion);
        $editForm = $this->createForm('AppBundle\Form\CodificacionType', $codificacion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('codificacion_edit', array('idCodificacion' => $codificacion->getIdcodificacion()));
        }

        return $this->render('codificacion/edit.html.twig', array(
            'codificacion' => $codificacion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a codificacion entity.
     *
     * @Route("/{idCodificacion}", name="codificacion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Codificacion $codificacion)
    {
        $form = $this->createDeleteForm($codificacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($codificacion);
            $em->flush();
        }

        return $this->redirectToRoute('codificacion_index');
    }

    /**
     * Creates a form to delete a codificacion entity.
     *
     * @param Codificacion $codificacion The codificacion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Codificacion $codificacion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('codificacion_delete', array('idCodificacion' => $codificacion->getIdcodificacion())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
