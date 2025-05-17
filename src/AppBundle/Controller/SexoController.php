<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sexo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Sexo controller.
 *
 * @Route("sexo")
 */
class SexoController extends Controller
{
    /**
     * Lists all sexo entities.
     *
     * @Route("/", name="sexo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sexos = $em->getRepository('AppBundle:Sexo')->findAll();

        return $this->render('sexo/index.html.twig', array(
            'sexos' => $sexos,
        ));
    }

    /**
     * Creates a new sexo entity.
     *
     * @Route("/new", name="sexo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $sexo = new Sexo();
        $form = $this->createForm('AppBundle\Form\SexoType', $sexo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sexo);
            $em->flush();

            return $this->redirectToRoute('sexo_show', array('idSexo' => $sexo->getIdsexo()));
        }

        return $this->render('sexo/new.html.twig', array(
            'sexo' => $sexo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sexo entity.
     *
     * @Route("/{idSexo}", name="sexo_show")
     * @Method("GET")
     */
    public function showAction(Sexo $sexo)
    {
        $deleteForm = $this->createDeleteForm($sexo);

        return $this->render('sexo/show.html.twig', array(
            'sexo' => $sexo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sexo entity.
     *
     * @Route("/{idSexo}/edit", name="sexo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Sexo $sexo)
    {
        $deleteForm = $this->createDeleteForm($sexo);
        $editForm = $this->createForm('AppBundle\Form\SexoType', $sexo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sexo_edit', array('idSexo' => $sexo->getIdsexo()));
        }

        return $this->render('sexo/edit.html.twig', array(
            'sexo' => $sexo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sexo entity.
     *
     * @Route("/{idSexo}", name="sexo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Sexo $sexo)
    {
        $form = $this->createDeleteForm($sexo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sexo);
            $em->flush();
        }

        return $this->redirectToRoute('sexo_index');
    }

    /**
     * Creates a form to delete a sexo entity.
     *
     * @param Sexo $sexo The sexo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sexo $sexo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sexo_delete', array('idSexo' => $sexo->getIdsexo())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
