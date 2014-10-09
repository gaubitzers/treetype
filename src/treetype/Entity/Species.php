<?php

namespace treetype\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Species
 *
 * @ORM\Table(name="species")
 * @ORM\Entity
 */
class Species
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="species_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="family", type="string", length=50, nullable=true)
     */
    private $family;

    /**
     * @var string
     *
     * @ORM\Column(name="genus", type="string", length=50, nullable=true)
     */
    private $genus;

    /**
     * @var string
     *
     * @ORM\Column(name="species", type="string", length=50, nullable=true)
     */
    private $species;



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
     * Set family
     *
     * @param string $family
     * @return Species
     */
    public function setFamily($family)
    {
        $this->family = $family;

        return $this;
    }

    /**
     * Get family
     *
     * @return string 
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * Set genus
     *
     * @param string $genus
     * @return Species
     */
    public function setGenus($genus)
    {
        $this->genus = $genus;

        return $this;
    }

    /**
     * Get genus
     *
     * @return string 
     */
    public function getGenus()
    {
        return $this->genus;
    }

    /**
     * Set species
     *
     * @param string $species
     * @return Species
     */
    public function setSpecies($species)
    {
        $this->species = $species;

        return $this;
    }

    /**
     * Get species
     *
     * @return string 
     */
    public function getSpecies()
    {
        return $this->species;
    }
}
