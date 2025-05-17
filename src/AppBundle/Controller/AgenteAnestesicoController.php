<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AgenteAnestesico;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Agenteanestesico controller.
 *
 * @Route("agenteanestesico")
 */
class AgenteAnestesicoController extends Controller
{
    /**
     * Lists all agenteAnestesico entities.
     *
     * @Route("/", name="agenteanestesico_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $agenteAnestesicos = $em->getRepository('AppBundle:AgenteAnestesico')->findAll();

        return $this->render('agenteanestesico/index.html.twig', array(
            'agenteAnestesicos' => $agenteAnestesicos,
        ));
    }

    /**
     * Creates a new agenteAnestesico entity.
     *
     * @Route("/new", name="agenteanestesico_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $agenteAnestesico = new Agenteanestesico();
        $form = $this->createForm('AppBundle\Form\AgenteAnestesicoType', $agenteAnestesico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($agenteAnestesico);
            $em->flush();

            return $this->redirectToRoute('agenteanestesico_show', array('idAgenteAnestesico' => $agenteAnestesico->getIdagenteanestesico()));
        }

        return $this->render('agenteanestesico/new.html.twig', array(
            'agenteAnestesico' => $agenteAnestesico,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a agenteAnestesico entity.
     *
     * @Route("/{idAgenteAnestesico}", name="agenteanestesico_show")
     * @Method("GET")
     */
    public function showAction(AgenteAnestesico $agenteAnestesico)
    {
        $deleteForm = $this->createDeleteForm($agenteAnestesico);

        return $this->render('agenteanestesico/show.html.twig', array(
            'agenteAnestesico' => $agenteAnestesico,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing agenteAnestesico entity.
     *
     * @Route("/{idAgenteAnestesico}/edit", name="agenteanestesico_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AgenteAnestesico $agenteAnestesico)
    {
        $deleteForm = $this->createDeleteForm($agenteAnestesico);
        $editForm = $this->createForm('AppBundle\Form\AgenteAnestesicoType', $agenteAnestesico);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('agenteanestesico_edit', array('idAgenteAnestesico' => $agenteAnestesico->getIdagenteanestesico()));
        }

        return $this->render('agenteanestesico/edit.html.twig', array(
            'agenteAnestesico' => $agenteAnestesico,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a agenteAnestesico entity.
     *
     * @Route("/{idAgenteAnestesico}", name="agenteanestesico_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AgenteAnestesico $agenteAnestesico)
    {
        $form = $this->createDeleteForm($agenteAnestesico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($agenteAnestesico);
            $em->flush();
        }

        return $this->redirectToRoute('agenteanestesico_index');
    }

    /**
     * Creates a form to delete a agenteAnestesico entity.
     *
     * @param AgenteAnestesico $agenteAnestesico The agenteAnestesico entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AgenteAnestesico $agenteAnestesico)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('agenteanestesico_delete', array('idAgenteAnestesico' => $agenteAnestesico->getIdagenteanestesico())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
