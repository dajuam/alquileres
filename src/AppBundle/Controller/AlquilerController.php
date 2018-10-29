<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class AlquilerController extends BaseAdminController
{

    protected $lastAlquiler;

    public function persistEntity($entity)
    {
        $inicio = $entity->getFechaInicio();
        $fin = $entity->getFechaFin();
        $interval = date_diff($inicio, $fin);
        $cantidadDias = $interval->d;
        $precioPorDia = $entity->getDepartamento()->getValorNoche();
        $alquileresCliente = $entity->getCliente()->getAlquileres();
        $valorFinal = $precioPorDia * $cantidadDias;
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
        $entity->setValorFinal($valorFinal);
        $this->em->persist($entity);
        $this->em->flush();
        $this->setLastAlquiler($entity);
    }

    protected function newAction()
    {
        $response = parent::newAction();
        if ($response instanceof RedirectResponse) {
            return $this->redirectToRoute('admin', [
                'entity' => 'Alquiler',
                'action' => 'show',
                'id' => $this->getLastAlquiler()->getId()
            ]);
        }
        return $response;
    }

    /**
     *
     * @return mixed
     */
    public function getLastAlquiler()
    {
        return $this->lastAlquiler;
    }

    /**
     *
     * @param mixed $lastAlquiler
     */
    public function setLastAlquiler($lastAlquiler)
    {
        $this->lastAlquiler = $lastAlquiler;
    }
}