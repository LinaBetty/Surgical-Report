<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sala;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Sala controller.
 *
 * @Route("sala")
 */
class SalaController extends Controller
{
    /**
     * Lists all sala entities.
     *
     * @Route("/", name="sala_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $salas = $em->getRepository('AppBundle:Sala')->findAll();

        return $this->render('sala/index.html.twig', array(
            'salas' => $salas,
        ));
    }

    /**
     * Creates a new sala entity.
     *
     * @Route("/new", name="sala_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $sala = new Sala();
        $form = $this->createForm('AppBundle\Form\SalaType', $sala);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sala);
            $em->flush();

            return $this->redirectToRoute('sala_show', array('idSala' => $sala->getIdsala()));
        }

        return $this->render('sala/new.html.twig', array(
            'sala' => $sala,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sala entity.
     *
     * @Route("/{idSala}", name="sala_show")
     * @Method("GET")
     */
    public function showAction(Sala $sala)
    {
        $deleteForm = $this->createDeleteForm($sala);

        return $this->render('sala/show.html.twig', array(
            'sala' => $sala,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sala entity.
     *
     * @Route("/{idSala}/edit", name="sala_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Sala $sala)
    {
        $deleteForm = $this->createDeleteForm($sala);
        $editForm = $this->createForm('AppBundle\Form\SalaType', $sala);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sala_edit', array('idSala' => $sala->getIdsala()));
        }

        return $this->render('sala/edit.html.twig', array(
            'sala' => $sala,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sala entity.
     *
     * @Route("/{idSala}", name="sala_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Sala $sala)
    {
        $form = $this->createDeleteForm($sala);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sala);
            $em->flush();
        }

        return $this->redirectToRoute('sala_index');
    }

    /**
     * Creates a form to delete a sala entity.
     *
     * @param Sala $sala The sala entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sala $sala)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sala_delete', array('idSala' => $sala->getIdsala())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
