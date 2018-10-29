<?php

namespace AppBundle\Service;

class AlquilerService
{
    public function calcularValor($alquiler) {
        //Preparo datos
        $inicio = $alquiler->getFechaInicio();
        $fin = $alquiler->getFechaFin();
        $interval = date_diff($inicio, $fin);
        $cantidadDias = $interval->d;
        $precioPorDia = $alquiler->getDepartamento()->getValorNoche();
        $alquileresCliente = $alquiler->getCliente()->getAlquileres();
        $valorFinal = $precioPorDia * $cantidadDias;
        
        // Calculo descuentos
        if ($cantidadDias > 4) {
            // Aplica 5%
            $valorFinal = $valorFinal - ($valorFinal * 5) / 100;
        } else {
            if ($cantidadDias > 15) {
                // Aplica 15%
                $valorFinal = $valorFinal - ($valorFinal * 15) / 100;
            }
        }
        // Descuento adicional por si ya alquilo alguna vez
        if (empty($alquileresCliente))
            $valorFinal = $valorFinal - ($valorFinal * 15) / 100;
            
            return $valorFinal;
    }
}

