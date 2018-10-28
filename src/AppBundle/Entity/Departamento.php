<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="departamento")
 */
class Departamento
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $ubicacion;

    /**
     * @ORM\Column(name="cantidad_ambientes", type="integer")
     */
    protected $cantidadAmbientes;

    /**
     * @ORM\Column(name="metros_cuadrados", type="decimal")
     */
    protected $metrosCuadrados;

    /**
     * @ORM\Column(name="valor_noche", type="decimal")
     */
    protected $valorNoche;

    /**
     * @ORM\Column(name="valor_mensual", type="decimal")
     */
    protected $valorMensual;
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * @return mixed
     */
    public function getCantidadAmbientes()
    {
        return $this->cantidadAmbientes;
    }

    /**
     * @return mixed
     */
    public function getMetrosCuadrados()
    {
        return $this->metrosCuadrados;
    }

    /**
     * @return mixed
     */
    public function getValorNoche()
    {
        return $this->valorNoche;
    }

    /**
     * @return mixed
     */
    public function getValorMensual()
    {
        return $this->valorMensual;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $ubicacion
     */
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;
    }

    /**
     * @param mixed $cantidadAmbientes
     */
    public function setCantidadAmbientes($cantidadAmbientes)
    {
        $this->cantidadAmbientes = $cantidadAmbientes;
    }

    /**
     * @param mixed $metrosCuadrados
     */
    public function setMetrosCuadrados($metrosCuadrados)
    {
        $this->metrosCuadrados = $metrosCuadrados;
    }

    /**
     * @param mixed $valorNoche
     */
    public function setValorNoche($valorNoche)
    {
        $this->valorNoche = $valorNoche;
    }

    /**
     * @param mixed $valorMensual
     */
    public function setValorMensual($valorMensual)
    {
        $this->valorMensual = $valorMensual;
    }

    public function __toString() {
        return "ss";
    }
}
