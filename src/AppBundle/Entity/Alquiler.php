<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="alquiler")
 */
class Alquiler
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="alquileres", cascade={"persist"})
     * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
     */
    protected $cliente;

    /**
     * @ORM\Column(name="fecha_inicio", type="date")
     */
    protected $fechaInicio;

    /**
     * @ORM\Column(name="fecha_fin", type="date")
     */
    protected $fechaFin;

    /**
     * @ORM\Column(name="valor_final", type="decimal")
     */
    protected $valorFinal;

    /**
     * @ORM\ManyToOne(targetEntity="Departamento", cascade={"persist"})
     * @ORM\JoinColumn(name="departamento_id", referencedColumnName="id")
     */
    protected $departamento;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cliente
     *
     * @param \AppBundle\Entity\Cliente $cliente
     *
     * @return Alquiler
     */
    public function setCliente(\AppBundle\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;
        return $this;
    }

    /**
     * Get cliente
     *
     * @return \AppBundle\Entity\Cliente
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     *
     * @return Alquiler
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;
        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     *
     * @return Alquiler
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;
        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set valorFinal
     *
     * @param string $valorFinal
     *
     * @return Alquiler
     */
    public function setValorFinal($valorFinal)
    {
        $this->valorFinal = $valorFinal;
        return $this;
    }

    /**
     * Get valorFinal
     *
     * @return string
     */
    public function getValorFinal()
    {
        return $this->valorFinal;
    }

    /**
     * Set departamento
     *
     * @param \AppBundle\Entity\Departamento $departamento
     *
     * @return Alquiler
     */
    public function setDepartamento(\AppBundle\Entity\Departamento $departamento = null)
    {
        $this->departamento = $departamento;
        return $this;
    }

    /**
     * Get departamento
     *
     * @return \AppBundle\Entity\Departamento
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    public function __toString()
    {
        return $this->getCliente()->getNombre() . " - " . $this->getDepartamento()->getUbicacion() .
            " / Desde: " . $this->getFechaInicio()->format("d/m/Y") . " Hasta: " . $this->getFechaFin()->format("d/m/Y");
    }
}
