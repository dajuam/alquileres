<?php
namespace Tests\AppBundle\Service;

use AppBundle\Entity\Alquiler;
use AppBundle\Entity\Cliente;
use AppBundle\Entity\Departamento;
use AppBundle\Service\AlquilerService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class AlquilerServiceTest extends KernelTestCase
{    
    private $container;
    private $entityManager;
        
    public function setUp()
    {
        self::bootKernel();
        $this->container = self::$kernel->getContainer();
        $this->entityManager = self::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    private function createAlquiler($cliente, $departamento, $dias) {
        $alquiler = new Alquiler();
        $alquiler->setCliente($cliente);
        $alquiler->setDepartamento($departamento);
        $alquiler->setFechaInicio(new \DateTime());
        $dia = new \DateTime();
        $dia->modify("+" . $dias . " days");
        $alquiler->setFechaFin($dia);
        return $alquiler;
    }

    private function getDepartamento() {
        // Alquila departamento que sale 2000 por noche
        $departamento = $this->entityManager
            ->getRepository(Departamento::class)
            ->findOneBy(array("ubicacion" => "Lavalle 400"));
        return $departamento;
    }

    private function getCliente($contacto) {
        $cliente = $this->entityManager
            ->getRepository(Cliente::class)
            ->findOneBy(array("email" => $contacto));
        return $cliente;
    }

    public function testMenorACuatroDias()
    {
        $alquilerService = $this->container->get(AlquilerService::class);

        // Maria no tiene alquileres
        $cliente = $this->getCliente("maria@gmail.com");

        // Alquila departamento que sale 2000 por noche
        $departamento = $this->getDepartamento();

        $alquiler = $this->createAlquiler($cliente, $departamento, 3);
        
        // No aplica descuento, por ende, 3*2000
        $this->assertEquals($alquilerService->calcularValor($alquiler), 6000);
    }

    public function testEntreCincoYQuinceDias()
    {
        $alquilerService = $this->container->get(AlquilerService::class);
        
        // Maria no tiene alquileres
        $cliente = $this->getCliente("maria@gmail.com");
        
        // Alquila departamento que sale 2000 por noche
        $departamento = $this->getDepartamento();
        
        $alquiler = $this->createAlquiler($cliente, $departamento, 8);
        
        // Tiene que aplicar descuento de 5% a 16000
        $this->assertEquals($alquilerService->calcularValor($alquiler), 15200);
    }

    public function testMasDeQuinceDias()
    {
        $alquilerService = $this->container->get(AlquilerService::class);
        
        // Maria no tiene alquileres
        $cliente = $this->getCliente("maria@gmail.com");
        
        // Alquila departamento que sale 2000 por noche
        $departamento = $this->getDepartamento();
        
        $alquiler = $this->createAlquiler($cliente, $departamento, 18);
        
        // Tiene que aplicar descuento de 15% a 36000
        $this->assertEquals($alquilerService->calcularValor($alquiler), 30600);
    }
    
    public function testMenorACuatroDiasCliente()
    {
        $alquilerService = $this->container->get(AlquilerService::class);
        
        // Juan es cliente
        $cliente = $this->getCliente("juan@gmail.com");
        
        // Alquila departamento que sale 2000 por noche
        $departamento = $this->getDepartamento();
        
        $alquiler = $this->createAlquiler($cliente, $departamento, 4);
        
        // Tiene que aplicar descuento de 5% por ser cliente al valor 8000
        $this->assertEquals($alquilerService->calcularValor($alquiler), 7600);
    }

    public function testEntreCincoYQuinceDiasCliente()
    {
        $alquilerService = $this->container->get(AlquilerService::class);
        
        // Juan es cliente
        $cliente = $this->getCliente("juan@gmail.com");
        
        // Alquila departamento que sale 2000 por noche
        $departamento = $this->getDepartamento();
        
        $alquiler = $this->createAlquiler($cliente, $departamento, 8);
        
        // Tiene que aplicar descuento de 5% a 16000
        // Tambien aplica descuento del 5% por ser cliente
        $this->assertEquals($alquilerService->calcularValor($alquiler), 14440);
    }

    public function testMasDeQuinceDiasCliente()
    {
        $alquilerService = $this->container->get(AlquilerService::class);
        
        // Juan es cliente
        $cliente = $this->getCliente("juan@gmail.com");
        
        // Alquila departamento que sale 2000 por noche
        $departamento = $this->getDepartamento();
        
        $alquiler = $this->createAlquiler($cliente, $departamento, 18);
        
        // Tiene que aplicar descuento de 15% a 36000
        // Tambien aplica descuento del 5% por ser cliente
        $this->assertEquals($alquilerService->calcularValor($alquiler), 29070);
    }
}

