<?php

namespace AppBundle\Service;

use AppBundle\Entity\Alquiler;
use Doctrine\ORM\EntityManagerInterface;

class AlquilerService
{
    private $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function esClienteBy($id) {
        return $this->em->getRepository(Alquiler::class)->findBy(array('cliente' => $id));
    }
    
    public function calcularValor($alquiler) {
        //Preparo datos
        $inicio = $alquiler->getFechaInicio();
        $fin = $alquiler->getFechaFin();
        $interval = date_diff($inicio, $fin);
        $cantidadDias = $interval->d;
        $precioPorDia = $alquiler->getDepartamento()->getValorNoche();

        $valorFinal = $precioPorDia * $cantidadDias;
        
        // Calculo descuentos
        if ($cantidadDias > 4 && $cantidadDias <= 15) {
            // Aplica 5%
            $valorFinal = $valorFinal - ($valorFinal * 5) / 100;
        } elseif ($cantidadDias > 15) {
            // Aplica 15%
            $valorFinal = $valorFinal - ($valorFinal * 15) / 100;
        }

        // Descuento adicional por si ya alquilo alguna vez
        if ($this->esClienteBy($alquiler->getCliente()->getId()) != null) {
            $valorFinal = $valorFinal - ($valorFinal * 5) / 100;
        }
            
        return $valorFinal;
    }
}

