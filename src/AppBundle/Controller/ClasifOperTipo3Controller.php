<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ClasifOperTipo3;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Clasifopertipo3 controller.
 *
 * @Route("clasifopertipo3")
 */
class ClasifOperTipo3Controller extends Controller
{
    /**
     * Lists all clasifOperTipo3 entities.
     *
     * @Route("/", name="clasifopertipo3_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clasifOperTipo3s = $em->getRepository('AppBundle:ClasifOperTipo3')->findAll();

        return $this->render('clasifopertipo3/index.html.twig', array(
            'clasifOperTipo3s' => $clasifOperTipo3s,
        ));
    }

    /**
     * Creates a new clasifOperTipo3 entity.
     *
     * @Route("/new", name="clasifopertipo3_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $clasifOperTipo3 = new Clasifopertipo3();
        $form = $this->createForm('AppBundle\Form\ClasifOperTipo3Type', $clasifOperTipo3);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($clasifOperTipo3);
            $em->flush();

            return $this->redirectToRoute('clasifopertipo3_show', array('idClasifOperTipo3' => $clasifOperTipo3->getIdclasifopertipo3()));
        }

        return $this->render('clasifopertipo3/new.html.twig', array(
            'clasifOperTipo3' => $clasifOperTipo3,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a clasifOperTipo3 entity.
     *
     * @Route("/{idClasifOperTipo3}", name="clasifopertipo3_show")
     * @Method("GET")
     */
    public function showAction(ClasifOperTipo3 $clasifOperTipo3)
    {
        $deleteForm = $this->createDeleteForm($clasifOperTipo3);

        return $this->render('clasifopertipo3/show.html.twig', array(
            'clasifOperTipo3' => $clasifOperTipo3,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing clasifOperTipo3 entity.
     *
     * @Route("/{idClasifOperTipo3}/edit", name="clasifopertipo3_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ClasifOperTipo3 $clasifOperTipo3)
    {
        $deleteForm = $this->createDeleteForm($clasifOperTipo3);
        $editForm = $this->createForm('AppBundle\Form\ClasifOperTipo3Type', $clasifOperTipo3);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('clasifopertipo3_edit', array('idClasifOperTipo3' => $clasifOperTipo3->getIdclasifopertipo3()));
        }

        return $this->render('clasifopertipo3/edit.html.twig', array(
            'clasifOperTipo3' => $clasifOperTipo3,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a clasifOperTipo3 entity.
     *
     * @Route("/{idClasifOperTipo3}", name="clasifopertipo3_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ClasifOperTipo3 $clasifOperTipo3)
    {
        $form = $this->createDeleteForm($clasifOperTipo3);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($clasifOperTipo3);
            $em->flush();
        }

        return $this->redirectToRoute('clasifopertipo3_index');
    }

    /**
     * Creates a form to delete a clasifOperTipo3 entity.
     *
     * @param ClasifOperTipo3 $clasifOperTipo3 The clasifOperTipo3 entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ClasifOperTipo3 $clasifOperTipo3)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('clasifopertipo3_delete', array('idClasifOperTipo3' => $clasifOperTipo3->getIdclasifopertipo3())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
