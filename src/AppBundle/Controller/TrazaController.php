<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Traza;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Traza controller.
 *
 * @Route("traza")
 */
class TrazaController extends Controller
{
    /**
     * Lists all traza entities.
     *
     * @Route("/", name="traza_index")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $trazas = $em->getRepository('AppBundle:Traza')->findAll(array(), array('idTraza' => 'DESC'));

        return $this->render('traza/index.html.twig', array(
            'trazas' => $trazas,
        ));
    }

//    /**
//     * Finds and displays a traza entity.
//     *
//     * @Route("/{idTraza}", name="traza_show")
//     * @Method("GET")
//     */
//    public function showAction(Traza $traza)
//    {
//
//        return $this->render('traza/show.html.twig', array(
//            'traza' => $traza,
//        ));
//    }
}
