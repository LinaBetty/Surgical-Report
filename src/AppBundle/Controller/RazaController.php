<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Raza;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Raza controller.
 *
 * @Route("raza")
 */
class RazaController extends Controller
{
    /**
     * Lists all raza entities.
     *
     * @Route("/", name="raza_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $razas = $em->getRepository('AppBundle:Raza')->findAll();

        return $this->render('raza/index.html.twig', array(
            'razas' => $razas,
        ));
    }

    /**
     * Creates a new raza entity.
     *
     * @Route("/new", name="raza_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $raza = new Raza();
        $form = $this->createForm('AppBundle\Form\RazaType', $raza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($raza);
            $em->flush();

            return $this->redirectToRoute('raza_show', array('idRaza' => $raza->getIdraza()));
        }

        return $this->render('raza/new.html.twig', array(
            'raza' => $raza,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a raza entity.
     *
     * @Route("/{idRaza}", name="raza_show")
     * @Method("GET")
     */
    public function showAction(Raza $raza)
    {
        $deleteForm = $this->createDeleteForm($raza);

        return $this->render('raza/show.html.twig', array(
            'raza' => $raza,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing raza entity.
     *
     * @Route("/{idRaza}/edit", name="raza_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Raza $raza)
    {
        $deleteForm = $this->createDeleteForm($raza);
        $editForm = $this->createForm('AppBundle\Form\RazaType', $raza);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('raza_edit', array('idRaza' => $raza->getIdraza()));
        }

        return $this->render('raza/edit.html.twig', array(
            'raza' => $raza,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a raza entity.
     *
     * @Route("/{idRaza}", name="raza_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Raza $raza)
    {
        $form = $this->createDeleteForm($raza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($raza);
            $em->flush();
        }

        return $this->redirectToRoute('raza_index');
    }

    /**
     * Creates a form to delete a raza entity.
     *
     * @param Raza $raza The raza entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Raza $raza)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('raza_delete', array('idRaza' => $raza->getIdraza())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
