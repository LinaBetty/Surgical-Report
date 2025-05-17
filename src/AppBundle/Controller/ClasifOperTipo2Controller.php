<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ClasifOperTipo2;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Clasifopertipo2 controller.
 *
 * @Route("clasifopertipo2")
 */
class ClasifOperTipo2Controller extends Controller
{
    /**
     * Lists all clasifOperTipo2 entities.
     *
     * @Route("/", name="clasifopertipo2_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clasifOperTipo2s = $em->getRepository('AppBundle:ClasifOperTipo2')->findAll();

        return $this->render('clasifopertipo2/index.html.twig', array(
            'clasifOperTipo2s' => $clasifOperTipo2s,
        ));
    }

    /**
     * Creates a new clasifOperTipo2 entity.
     *
     * @Route("/new", name="clasifopertipo2_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $clasifOperTipo2 = new Clasifopertipo2();
        $form = $this->createForm('AppBundle\Form\ClasifOperTipo2Type', $clasifOperTipo2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($clasifOperTipo2);
            $em->flush();

            return $this->redirectToRoute('clasifopertipo2_show', array('idClasifOperTipo2' => $clasifOperTipo2->getIdclasifopertipo2()));
        }

        return $this->render('clasifopertipo2/new.html.twig', array(
            'clasifOperTipo2' => $clasifOperTipo2,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a clasifOperTipo2 entity.
     *
     * @Route("/{idClasifOperTipo2}", name="clasifopertipo2_show")
     * @Method("GET")
     */
    public function showAction(ClasifOperTipo2 $clasifOperTipo2)
    {
        $deleteForm = $this->createDeleteForm($clasifOperTipo2);

        return $this->render('clasifopertipo2/show.html.twig', array(
            'clasifOperTipo2' => $clasifOperTipo2,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing clasifOperTipo2 entity.
     *
     * @Route("/{idClasifOperTipo2}/edit", name="clasifopertipo2_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ClasifOperTipo2 $clasifOperTipo2)
    {
        $deleteForm = $this->createDeleteForm($clasifOperTipo2);
        $editForm = $this->createForm('AppBundle\Form\ClasifOperTipo2Type', $clasifOperTipo2);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('clasifopertipo2_edit', array('idClasifOperTipo2' => $clasifOperTipo2->getIdclasifopertipo2()));
        }

        return $this->render('clasifopertipo2/edit.html.twig', array(
            'clasifOperTipo2' => $clasifOperTipo2,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a clasifOperTipo2 entity.
     *
     * @Route("/{idClasifOperTipo2}", name="clasifopertipo2_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ClasifOperTipo2 $clasifOperTipo2)
    {
        $form = $this->createDeleteForm($clasifOperTipo2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($clasifOperTipo2);
            $em->flush();
        }

        return $this->redirectToRoute('clasifopertipo2_index');
    }

    /**
     * Creates a form to delete a clasifOperTipo2 entity.
     *
     * @param ClasifOperTipo2 $clasifOperTipo2 The clasifOperTipo2 entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ClasifOperTipo2 $clasifOperTipo2)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('clasifopertipo2_delete', array('idClasifOperTipo2' => $clasifOperTipo2->getIdclasifopertipo2())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
