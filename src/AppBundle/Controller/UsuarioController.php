<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Traza;
use AppBundle\Entity\Usuario;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Usuario controller.
 *
 * @Route("usuario")
 */
class UsuarioController extends Controller
{
    /**
     * Lists all usuario entities.
     *
     * @Route("/", name="usuario_index")
     * @Method("GET")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $usuarios = $em->getRepository('AppBundle:Usuario')->findAll();

        return $this->render('usuario/index.html.twig', array(
            'usuarios' => $usuarios,
        ));
    }

    /**
     * Creates a new usuario entity.
     *
     * @Route("/new", name="usuario_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $usuario = new Usuario();
        $form = $this->createForm('AppBundle\Form\UsuarioType', $usuario);
        $form->handleRequest($request);

        //          Validando entreda de un usuario repetido
        $repository = $this->getDoctrine()->getRepository(Usuario::class);
        $usernameRepetido = $repository->findOneBy([
            'username' => $usuario->getUsername(),
        ]);
        $emailRepetido = $repository->findOneBy([
            'email' => $usuario->getEmail(),
        ]);
        $trabajadorRepetido = $repository->findOneBy([
            'personalFk' => $usuario->getPersonalFk(),
        ]);
//        $trabajadorRepetido = null;

        if ($usernameRepetido != null or $emailRepetido != null or $trabajadorRepetido != null) {
//            $form->addError(new FormError('ERROR! El paciente ya existe.'));
            $this->get('session')->getFlashBag()->set(
                'danger',
                array(
                    'title' => 'ERROR!',
                    'message' => 'Ya existe un usuario con estos datos'
                ));
            return $this->redirect($this->generateUrl('usuario_new'));
        }

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($usuario, $usuario->getPlainPassword());
            $usuario->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();

            //          Registrando en las trazas la insercion
            $traza = new Traza();
            $traza->setAccionRealizada('Se ha registrado una nueva cuenta para el usuario ' . $usuario->getPersonalFk()->getNombre() . ' con persmiso de ' . $usuario->getRol());
            $user = $this->getUser();
            $traza->setUsuarioFk($user);
            $fecha = getdate();
            $temp = new \DateTime();
            $temp->setDate($fecha['year'], $fecha['mon'], $fecha['mday']);
            $traza->setFecha($temp);
            $hora = new \DateTime();
            $hora->setTime(date("H"), date("i"), date("s"));
            $hora->format('H:i:s');
            $traza->setHora($hora);
            $em->persist($traza);
            $em->flush();

            $this->get('session')->getFlashBag()->set(
                'danger',
                array(
                    'title' => '',
                    'message' => 'Se ha registrado al usuario ' . $usuario->getUsername() . ' satisfactoriamente.'
                ));
            return $this->redirectToRoute('usuario_index');
        }

        return $this->render('usuario/new.html.twig', array(
            'usuario' => $usuario,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a usuario entity.
     *
     * @Route("/{id}", name="usuario_show")
     * @Method("GET")
     */
    public function showAction(Usuario $usuario)
    {
        $deleteForm = $this->createDeleteForm($usuario);

        return $this->render('usuario/show.html.twig', array(
            'usuario' => $usuario,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing usuario entity.
     *
     * @Route("/{id}/edit", name="usuario_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Usuario $usuario, UserPasswordEncoderInterface $passwordEncoder, Swift_Mailer $mailer)
    {
        $deleteForm = $this->createDeleteForm($usuario);
        $editForm = $this->createForm('AppBundle\Form\UsuarioType', $usuario);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $password = $passwordEncoder->encodePassword($usuario, $usuario->getPlainPassword());
            $usuario->setPassword($password);
            $this->getDoctrine()->getManager()->flush();

            //          Registrando en las trazas la edicion
            $em = $this->getDoctrine()->getManager();
            $traza = new Traza();
            $traza->setAccionRealizada('Se ha editado la cuenta del usuario ' . $usuario->getPersonalFk()->getNombre() . ' con persmiso de ' . $usuario->getRol());
            $user = $this->getUser();
            $traza->setUsuarioFk($user);
            $fecha = getdate();
            $temp = new \DateTime();
            $temp->setDate($fecha['year'], $fecha['mon'], $fecha['mday']);
            $traza->setFecha($temp);
            $hora = new \DateTime();
            $hora->setTime(date("H"), date("i"), date("s"));
            $hora->format('H:i:s');
            $traza->setHora($hora);
            $em->persist($traza);
            $em->flush();

            if ($user->getRol() == 'ROLE_ADMIN') {

                if ($user->getUsername() != $usuario->getUsername()) {
//              Enviando notificacion al usuario de que su cuenta ha sido modificada por el admin
                    $message = (new \Swift_Message('SIGOC Cambios en tu cuenta'))
                        ->setFrom('linauribazo25@gmail.com')
//                        ->setTo($usuario->getEmail())
                        ->setTo('linauribazo25@gmail.com')
                        ->setBody(
                            $this->renderView(
                            // app/Resources/views/Emails/registration.html.twig
                                '/email/emailedit.html.twig',['user' => $user,'usuario' => $usuario]
                            ),
                            'text/html'
                        )
                        ->addPart(
                            $this->renderView(
                                '/email/emailedit.html.twig',['user' => $user,'usuario' => $usuario]
                            ),
                            'text/plain'
                        );
                    $mailer->send($message);
                }
                $this->get('session')->getFlashBag()->set(
                    'danger',
                    array(
                        'title' => 'COMPLETADO.',
                        'message' => 'Los datos del usuario ' . $usuario->getUsername() . ' han sido actualizados satisfactoriamente.'
                    ));
                return $this->redirectToRoute('usuario_index');
            } else {
                $this->get('session')->getFlashBag()->set(
                    'danger',
                    array(
                        'title' => 'COMPLETADO.',
                        'message' => 'Los datos de su usuario han sido actualizados satisfactoriamente.'
                    ));
                return $this->redirectToRoute('usuario_edit', ['id' => $usuario->getId()]);
            }

        }

        return $this->render('usuario/edit.html.twig', array(
            'usuario' => $usuario,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a usuario entity.
     *
     * @Route("/{id}/delete", name="usuario_delete")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Usuario $usuario)
    {
        $form = $this->createDeleteForm($usuario);
        $form->handleRequest($request);

        //          Registrando en las trazas la eliminacion
        $em = $this->getDoctrine()->getManager();
        $traza = new Traza();
        $traza->setAccionRealizada('Se ha eliminado la cuenta del usuario ' . $usuario->getPersonalFk()->getNombre() . ' con persmiso de ' . $usuario->getRol());
        $user = $this->getUser();
        $traza->setUsuarioFk($user);
        $fecha = getdate();
        $temp = new \DateTime();
        $temp->setDate($fecha['year'], $fecha['mon'], $fecha['mday']);
        $traza->setFecha($temp);
        $hora = new \DateTime();
        $hora->setTime(date("H"), date("i"), date("s"));
        $hora->format('H:i:s');
        $traza->setHora($hora);
        $em->persist($traza);
        $em->flush();

//        if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($usuario);
        $em->flush();
//        }

        $this->get('session')->getFlashBag()->set(
            'danger',
            array(
                'title' => '',
                'message' => 'Se ha eliminado al usuario ' . $usuario->getUsername() . ' satisfactoriamente.'
            ));

        return $this->redirectToRoute('usuario_index');
//        return new Response(
//            $usuario->getUsername()
//        );
    }

    /**
     * Creates a form to delete a usuario entity.
     *
     * @param Usuario $usuario The usuario entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Usuario $usuario)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('usuario_delete', array('id' => $usuario->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * Permite editar informacion del usuario que esta logueado
     *
     * @Route("/editlogged", name="edit_logged")
     * @Method({"GET", "POST"})
     */
    public function editLogged(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = $this->getUser();
        return $this->editAction($request, $user, $passwordEncoder);
    }


}
