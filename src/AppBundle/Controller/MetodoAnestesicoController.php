<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MetodoAnestesico;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Metodoanestesico controller.
 *
 * @Route("metodoanestesico")
 */
class MetodoAnestesicoController extends Controller
{
    /**
     * Lists all metodoAnestesico entities.
     *
     * @Route("/", name="metodoanestesico_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $metodoAnestesicos = $em->getRepository('AppBundle:MetodoAnestesico')->findAll();

        return $this->render('metodoanestesico/index.html.twig', array(
            'metodoAnestesicos' => $metodoAnestesicos,
        ));
    }

    /**
     * Creates a new metodoAnestesico entity.
     *
     * @Route("/new", name="metodoanestesico_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $metodoAnestesico = new Metodoanestesico();
        $form = $this->createForm('AppBundle\Form\MetodoAnestesicoType', $metodoAnestesico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($metodoAnestesico);
            $em->flush();

            return $this->redirectToRoute('metodoanestesico_show', array('idMetodoAnestesico' => $metodoAnestesico->getIdmetodoanestesico()));
        }

        return $this->render('metodoanestesico/new.html.twig', array(
            'metodoAnestesico' => $metodoAnestesico,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a metodoAnestesico entity.
     *
     * @Route("/{idMetodoAnestesico}", name="metodoanestesico_show")
     * @Method("GET")
     */
    public function showAction(MetodoAnestesico $metodoAnestesico)
    {
        $deleteForm = $this->createDeleteForm($metodoAnestesico);

        return $this->render('metodoanestesico/show.html.twig', array(
            'metodoAnestesico' => $metodoAnestesico,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing metodoAnestesico entity.
     *
     * @Route("/{idMetodoAnestesico}/edit", name="metodoanestesico_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, MetodoAnestesico $metodoAnestesico)
    {
        $deleteForm = $this->createDeleteForm($metodoAnestesico);
        $editForm = $this->createForm('AppBundle\Form\MetodoAnestesicoType', $metodoAnestesico);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('metodoanestesico_edit', array('idMetodoAnestesico' => $metodoAnestesico->getIdmetodoanestesico()));
        }

        return $this->render('metodoanestesico/edit.html.twig', array(
            'metodoAnestesico' => $metodoAnestesico,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a metodoAnestesico entity.
     *
     * @Route("/{idMetodoAnestesico}", name="metodoanestesico_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, MetodoAnestesico $metodoAnestesico)
    {
        $form = $this->createDeleteForm($metodoAnestesico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($metodoAnestesico);
            $em->flush();
        }

        return $this->redirectToRoute('metodoanestesico_index');
    }

    /**
     * Creates a form to delete a metodoAnestesico entity.
     *
     * @param MetodoAnestesico $metodoAnestesico The metodoAnestesico entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(MetodoAnestesico $metodoAnestesico)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('metodoanestesico_delete', array('idMetodoAnestesico' => $metodoAnestesico->getIdmetodoanestesico())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
