<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use AppBundle\Service\AlquilerService;

class AlquilerController extends BaseAdminController
{

    protected $lastAlquiler;

    public function persistEntity($entity)
    {
        $entity->setValorFinal($this->get(AlquilerService::class)->calcularValor($entity));
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