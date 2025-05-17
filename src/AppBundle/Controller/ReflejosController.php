<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Reflejos;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Reflejo controller.
 *
 * @Route("reflejos")
 */
class ReflejosController extends Controller
{
    /**
     * Lists all reflejo entities.
     *
     * @Route("/", name="reflejos_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reflejos = $em->getRepository('AppBundle:Reflejos')->findAll();

        return $this->render('reflejos/index.html.twig', array(
            'reflejos' => $reflejos,
        ));
    }

    /**
     * Creates a new reflejo entity.
     *
     * @Route("/new", name="reflejos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $reflejo = new Reflejo();
        $form = $this->createForm('AppBundle\Form\ReflejosType', $reflejo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reflejo);
            $em->flush();

            return $this->redirectToRoute('reflejos_show', array('idReflejos' => $reflejo->getIdreflejos()));
        }

        return $this->render('reflejos/new.html.twig', array(
            'reflejo' => $reflejo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reflejo entity.
     *
     * @Route("/{idReflejos}", name="reflejos_show")
     * @Method("GET")
     */
    public function showAction(Reflejos $reflejo)
    {
        $deleteForm = $this->createDeleteForm($reflejo);

        return $this->render('reflejos/show.html.twig', array(
            'reflejo' => $reflejo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reflejo entity.
     *
     * @Route("/{idReflejos}/edit", name="reflejos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Reflejos $reflejo)
    {
        $deleteForm = $this->createDeleteForm($reflejo);
        $editForm = $this->createForm('AppBundle\Form\ReflejosType', $reflejo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reflejos_edit', array('idReflejos' => $reflejo->getIdreflejos()));
        }

        return $this->render('reflejos/edit.html.twig', array(
            'reflejo' => $reflejo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reflejo entity.
     *
     * @Route("/{idReflejos}", name="reflejos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Reflejos $reflejo)
    {
        $form = $this->createDeleteForm($reflejo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reflejo);
            $em->flush();
        }

        return $this->redirectToRoute('reflejos_index');
    }

    /**
     * Creates a form to delete a reflejo entity.
     *
     * @param Reflejos $reflejo The reflejo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reflejos $reflejo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reflejos_delete', array('idReflejos' => $reflejo->getIdreflejos())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
