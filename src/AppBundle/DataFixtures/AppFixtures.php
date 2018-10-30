<?php
namespace AppBundle\DataFixtures;

use AppBundle\Entity\Alquiler;
use AppBundle\Entity\Cliente;
use AppBundle\Entity\Departamento;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {        
        $cliente = new Cliente();
        $cliente->setEmail("juan@gmail.com");
        $cliente->setNombre("juan");
        
        $departamento = new Departamento();
        $departamento->setValorMensual("500");
        $departamento->setCantidadAmbientes(3);
        $departamento->setMetrosCuadrados(4);
        $departamento->setValorMensual(40000);
        $departamento->setUbicacion("Lavalle 400");
        $departamento->setValorNoche(2000);
        
        $alquiler = new Alquiler();
        $alquiler->setDepartamento($departamento);
        $alquiler->setCliente($cliente);
        $alquiler->setFechaInicio(new \DateTime());
        $dia = new \DateTime();
        $dia->modify("+2 days");
        $alquiler->setFechaFin($dia);
        $alquiler->setValorFinal(0);

        $manager->persist($alquiler);
        $manager->flush();

        $cliente2 = new Cliente();
        $cliente2->setEmail("maria@gmail.com");
        $cliente2->setNombre("Maria");
        $manager->persist($cliente2);
        $manager->flush();
    }
}