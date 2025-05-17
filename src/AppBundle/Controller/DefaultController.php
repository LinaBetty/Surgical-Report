<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Municipio;
use AppBundle\Entity\Operacion;
use AppBundle\Entity\Personal;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Operacion::class);
        $repositoryP = $this->getDoctrine()->getRepository(Personal::class);
        $em = $this->getDoctrine()->getManager();

//      Calculando la cant y % de hombres y mujeres operados
        $cantOper = count($repository->findAll());
//        $cantH = count($repository->findBy(['pacienteFk.sexoFk.nombre' => 'Masculino']));
        $query = $em->createQuery("SELECT op FROM AppBundle\Entity\Operacion op JOIN op.pacienteFk pac JOIN pac.sexoFk sexo WHERE sexo.nombre = 'Masculino' ");
        $cantH = count($query->getResult());
//        $cantM = count($repository->findBy(['pacienteFk.sexoFk.nombre' => 'Femenino']));
        $query = $em->createQuery("SELECT op FROM AppBundle\Entity\Operacion op JOIN op.pacienteFk pac JOIN pac.sexoFk sexo WHERE sexo.nombre = 'Femenino' ");
        $cantM = count($query->getResult());
        $porcientoH = $cantH * 100 / $cantOper;
        $porcientoM = $cantM * 100 / $cantOper;

//      Calculando la cant y % operados segun su edad
        $query = $em->createQuery(
            'SELECT p
        FROM AppBundle\Entity\Operacion p
        WHERE p.edadPaciente > 20
        and p.edadPaciente < 40'
        );
        $cant20 = count($query->execute());

        $query = $em->createQuery(
            'SELECT p
        FROM AppBundle\Entity\Operacion p
        WHERE p.edadPaciente > 41
        and p.edadPaciente < 61'
        );
        $cant41 = count($query->execute());

        $query = $em->createQuery(
            'SELECT p
        FROM AppBundle\Entity\Operacion p
        WHERE p.edadPaciente > 61
        and p.edadPaciente < 81'
        );
        $cant61 = count($query->execute());

        $query = $em->createQuery(
            'SELECT p
        FROM AppBundle\Entity\Operacion p
        WHERE p.edadPaciente > 81'
        );
        $cant81 = count($query->execute());

        $porciento20 = $cant20 * 100 / $cantOper;
        $porciento41 = $cant41 * 100 / $cantOper;
        $porciento61 = $cant61 * 100 / $cantOper;
        $porciento81 = $cant81 * 100 / $cantOper;

        //      Calculando la cant operados por cirujano(no %)
//        $cirujanos = $repositoryP->findBy(['tipoPersonalFk.nombre' => 'Cirujano']);
        $query = $em->createQuery("SELECT cir FROM AppBundle\Entity\Personal cir JOIN cir.tipoPersonalFk tipo WHERE tipo.nombre = 'Cirujano' ");
        $cirujanos = $query->getResult();
        $operPorCirujano = array();
        for ($i = 0; $i < count($cirujanos); $i++) {
            $operPorCirujano[] = count($repository->findBy(['cirujanoFk' => $cirujanos[$i]]));
        }

        //      Calculando la cant operados por municipio(no %)
        $repositoryM = $this->getDoctrine()->getRepository(Municipio::class);
        $municipios = $repositoryM->findBy(['nombreProvincia' => 'Santiago de Cuba']);
        $operPorMunicipio = array();
        for ($i = 0; $i < count($municipios); $i++) {
//            $operPorMunicipio[] = count($repository->findBy(['pacienteFk.municipioFk' => $municipios[$i]]));
            $nombre = $municipios[$i]->getNombre();
            $query = $em->createQuery("SELECT op FROM AppBundle\Entity\Operacion op JOIN op.pacienteFk pac JOIN pac.municipioFk mun WHERE mun.nombre = '$nombre' ");
            $operPorMunicipio[] = count($query->getResult());
        }

        $query1 = $em->createQuery("SELECT op FROM AppBundle\Entity\Operacion op JOIN op.estadoSalirSalonFk est WHERE est.nombre = 'Satisfactorio' ");
        $cantSatis = count($query1->getResult());

        // replace this example code with whatever you need
        return $this->render('base.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'municipios' => $municipios,
            'operPorMunicipio' => $operPorMunicipio,
            'cirujanos' => $cirujanos,
            'operPorCirujano' => $operPorCirujano,
            'cant20' => $cant20,
            'cant41' => $cant41,
            'cant61' => $cant61,
            'cant81' => $cant81,
            'cantOper' => $cantOper,
            'cantH' => $cantH,
            'cantM' => $cantM,
            'cantSatis' => $cantSatis,
        ]);
    }

    /**
     * @Route("/test", name="test"))
     */
    public function testAction()
    {
        $temp = new \DateTime();
        $temp->setTime(date("G"), date("i"), date("s"));
        return new Response(
            date("H")
        );
    }

    public function cantOperCir(){
        //      Calculando la cant operados por cirujano(no %)
//        $cirujanos = $repositoryP->findBy(['tipoPersonalFk.nombre' => 'Cirujano']);
        $repository = $this->getDoctrine()->getRepository(Operacion::class);
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT cir FROM AppBundle\Entity\Personal cir JOIN cir.tipoPersonalFk tipo WHERE tipo.nombre = 'Cirujano' ");
        $cirujanos = $query->getResult();
        $operPorCirujano = array();
        for ($i = 0; $i < count($cirujanos); $i++) {
            $operPorCirujano[] = count($repository->findBy(['cirujanoFk' => $cirujanos[$i]]));
        }
        return $operPorCirujano;
    }
}
