<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Traza;
use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('registration/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(Request $request)
    {
        // UNREACHABLE CODE

    }

    /**
     * @Route("/cerrarsesion", name="cerrarsesion")
     */
    public function cerrarSesion(Request $request, AuthenticationUtils $authenticationUtils)
    {
//                  Registrando en las trazas el cierre de sesion
        $em = $this->getDoctrine()->getManager();
        $traza = new Traza();
        $user = $this->getUser();
        $traza->setAccionRealizada('Ha cerrado sesión en el sistema el usuario ' . $user->getUsername() . ' con permiso de ' . $user->getRol());
        $traza->setUsuarioFk($user);
        $fecha = getdate();
        $temp = new \DateTime();
        $temp->setDate($fecha['year'], $fecha['mon'], $fecha['mday']);
        $traza->setFecha($temp);
        $hora = new \DateTime();
        $hora->setTime(date("H"), date("i"), date("s"));
        $traza->setHora($hora);
        $em->persist($traza);
        $em->flush();
//        $this->logoutAction($request);
//
//        // get the login error if there is one
//        $error = $authenticationUtils->getLastAuthenticationError();
//
//        // last username entered by the user
//        $lastUsername = $authenticationUtils->getLastUsername();
//
//        return $this->render('registration/login.html.twig', [
//            'last_username' => $lastUsername,
//            'error' => $error,
//        ]);
        return $this->redirectToRoute('logout');
    }


    /** * Redirect users after login based on the granted ROLE
     * @Route("/login/redirect", name="_login_redirect")
     */
    public function loginRedirectAction(Request $request)
    {
        //          Registrando en las trazas el inicio de sesion
        $em = $this->getDoctrine()->getManager();
        $traza = new Traza();
        $user = $this->getUser();
        if ($user->getRol() == 'ROLE_ADMIN') {
            $role = 'Administrador';
        } else {
            $role = 'Cirujano';
        }
        $traza->setAccionRealizada(' Ha iniciado sesión en el sistema el usuario ' . $user->getUsername() . ' con permiso de ' . $role);
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

        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('homepage');
        } else {
//            return $this->redirectToRoute('escudo_index');
            return $this->redirectToRoute('homepage');
        }
    }

    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new Usuario();
        $form = $this->createForm(UsuarioType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'registration/register2.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * Send an email to recover a missing password.
     *
     * @Route("/recover", name="recover_password")
     * @Method({"GET", "POST"})
     */
    public function recover(Request $request, \Swift_Mailer $mailer, UserPasswordEncoderInterface $passwordEncoder)
    {
        $defaultData = array('username' => '');
        $form = $this->createFormBuilder($defaultData)
            ->add('username', TextType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

//            $username = $request->request->get('username');
            $data = $form->getData();

//            return new Response($data['username']);

            //          Validando entreda de un usuario inexistente
            $repository = $this->getDoctrine()->getRepository(Usuario::class);
            $user = $repository->findOneBy([
                'username' => $data['username'],
            ]);

            if ($user == null) {
                $this->get('session')->getFlashBag()->set(
                    'danger',
                    array(
                        'title' => 'ERROR!',
                        'message' => 'El nombre de usuario entrado no existe.'
                    ));
                return $this->redirect($this->generateUrl('recover_password'));
            }

//          Generando nueva contrasenna
            $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789*/';
            $longpalabra = 8;
            for ($pass = '', $n = strlen($caracteres) - 1; strlen($pass) < $longpalabra;) {
                $x = rand(0, $n);
                $pass .= $caracteres[$x];
            }

//          Actualizando contrasenna nueva
            $entityManager = $this->getDoctrine()->getManager();
            $usuario = $entityManager->getRepository(Usuario::class)->find($user->getId());
            $password = $passwordEncoder->encodePassword($usuario, $pass);
            $usuario->setPassword($password);
            $entityManager->flush();

//          Enviando correo con nueva contrasenna
            $message = (new \Swift_Message('SIGOC Recuperar Contraseña'))
                ->setFrom('linauribazo25@gmail.com')
                ->setTo($user->getEmail())
                ->setBody(
                    $this->renderView(
                    // app/Resources/views/Emails/registration.html.twig
                        '/email/emailrecover.html.twig',
                        ['user' => $user, 'newpass' => $pass]
                    ),
                    'text/html'
                )
                ->addPart(
                    $this->renderView(
                        '/email/emailrecover.html.twig',
                        ['user' => $user, 'newpass' => $pass]
                    ),
                    'text/plain'
                );

            $mailer->send($message);

            $enviado = 'El correo se ha enviado satisfactoriamente por favor revíselo para ver su nueva contraseña.';
            return $this->render('/registration/recover.html.twig', array(
                'form' => $form->createView(),
                'enviado' => $enviado,
            ));
        }

        return $this->render('/registration/recover.html.twig', array(
            'form' => $form->createView(),
            'enviado' => '',
        ));
    }

//    /**
//     * Redirecciona y loguea al usuario que recibio el correo para cambiar su contrasenna.
//     *
//     * @Route("recover/{idUser}/redirect", name="redirect_recover")
//     * @Method("GET")
//     */
//    public function redirectToRecover($idUser,UserPasswordEncoderInterface $passwordEncoder, Request $request)
//    {
//        $repository = $this->getDoctrine()->getRepository(Usuario::class);
//        $user = $repository->find($idUser);
//
//        // Manually authenticate user in controller
//        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
//        $this->get('security.token_storage')->setToken($token);
//        $this->get('session')->set('_security_main', serialize($token));
//        // Fire the login event manually
//        $event = new InteractiveLoginEvent($request, $token);
//        $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);
//
//
////        $response = $this->forward('AppBundle:Usuario:edit', [
////            'request' => $request,
////            'usuario'  => $user,
////            'passwordEncoder' => $passwordEncoder,
////        ]);
////
////        return $response;
//        //          Registrando en las trazas el cambio de contrasenna por olvido
//        $em = $this->getDoctrine()->getManager();
//        $traza = new Traza();
//        $user = $this->getUser();
//        $traza->setAccionRealizada('el usuario' . $user->getUsername() . ' con permiso de ' . $user->getRol() .' ha olvidado su contraseña, se le ha enviado un correo para que acceda a cambiarla.');
//        $traza->setUsuarioFk($user);
//        $fecha = getdate();
//        $temp = new \DateTime();
//        $temp->setDate($fecha['year'], $fecha['mon'], $fecha['mday']);
//        $traza->setFecha($temp);
//        $hora = new \DateTime();
//        $hora->setTime(date("H"), date("i"), date("s"));
//        $hora->format('H:i:s');
//        $traza->setHora($hora);
//        $em->persist($traza);
//        $em->flush();
//
//        return $this->redirectToRoute('usuario_edit',['id' => $idUser]);
//    }
}
