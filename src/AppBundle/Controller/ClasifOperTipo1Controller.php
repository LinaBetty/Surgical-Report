<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ClasifOperTipo1;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Clasifopertipo1 controller.
 *
 * @Route("clasifopertipo1")
 */
class ClasifOperTipo1Controller extends Controller
{
    /**
     * Lists all clasifOperTipo1 entities.
     *
     * @Route("/", name="clasifopertipo1_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clasifOperTipo1s = $em->getRepository('AppBundle:ClasifOperTipo1')->findAll();

        return $this->render('clasifopertipo1/index.html.twig', array(
            'clasifOperTipo1s' => $clasifOperTipo1s,
        ));
    }

    /**
     * Creates a new clasifOperTipo1 entity.
     *
     * @Route("/new", name="clasifopertipo1_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $clasifOperTipo1 = new Clasifopertipo1();
        $form = $this->createForm('AppBundle\Form\ClasifOperTipo1Type', $clasifOperTipo1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($clasifOperTipo1);
            $em->flush();

            return $this->redirectToRoute('clasifopertipo1_show', array('idClasifOperTipo1' => $clasifOperTipo1->getIdclasifopertipo1()));
        }

        return $this->render('clasifopertipo1/new.html.twig', array(
            'clasifOperTipo1' => $clasifOperTipo1,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a clasifOperTipo1 entity.
     *
     * @Route("/{idClasifOperTipo1}", name="clasifopertipo1_show")
     * @Method("GET")
     */
    public function showAction(ClasifOperTipo1 $clasifOperTipo1)
    {
        $deleteForm = $this->createDeleteForm($clasifOperTipo1);

        return $this->render('clasifopertipo1/show.html.twig', array(
            'clasifOperTipo1' => $clasifOperTipo1,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing clasifOperTipo1 entity.
     *
     * @Route("/{idClasifOperTipo1}/edit", name="clasifopertipo1_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ClasifOperTipo1 $clasifOperTipo1)
    {
        $deleteForm = $this->createDeleteForm($clasifOperTipo1);
        $editForm = $this->createForm('AppBundle\Form\ClasifOperTipo1Type', $clasifOperTipo1);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('clasifopertipo1_edit', array('idClasifOperTipo1' => $clasifOperTipo1->getIdclasifopertipo1()));
        }

        return $this->render('clasifopertipo1/edit.html.twig', array(
            'clasifOperTipo1' => $clasifOperTipo1,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a clasifOperTipo1 entity.
     *
     * @Route("/{idClasifOperTipo1}", name="clasifopertipo1_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ClasifOperTipo1 $clasifOperTipo1)
    {
        $form = $this->createDeleteForm($clasifOperTipo1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($clasifOperTipo1);
            $em->flush();
        }

        return $this->redirectToRoute('clasifopertipo1_index');
    }

    /**
     * Creates a form to delete a clasifOperTipo1 entity.
     *
     * @param ClasifOperTipo1 $clasifOperTipo1 The clasifOperTipo1 entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ClasifOperTipo1 $clasifOperTipo1)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('clasifopertipo1_delete', array('idClasifOperTipo1' => $clasifOperTipo1->getIdclasifopertipo1())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
