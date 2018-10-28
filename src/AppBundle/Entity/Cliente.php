<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="cliente")
 */
class Cliente
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
    protected $nombre;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $email;

    /**
     * @ORM\OneToMany(targetEntity="Alquiler", mappedBy="cliente")
     */
    protected $alquileres;

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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Cliente
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Cliente
     */
    public function setEmail($email)
    {
        $this->email = $email;
        
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->alquileres = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add alquilere
     *
     * @param \AppBundle\Entity\Alquiler $alquilere
     *
     * @return Cliente
     */
    public function addAlquilere(\AppBundle\Entity\Alquiler $alquilere)
    {
        $this->alquileres[] = $alquilere;

        return $this;
    }

    /**
     * Remove alquilere
     *
     * @param \AppBundle\Entity\Alquiler $alquilere
     */
    public function removeAlquilere(\AppBundle\Entity\Alquiler $alquilere)
    {
        $this->alquileres->removeElement($alquilere);
    }

    /**
     * Get alquileres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAlquileres()
    {
        return $this->alquileres;
    }

    public function __toString() {
        return $this->getNombre() . " / " . $this->getEmail();
    }
}
