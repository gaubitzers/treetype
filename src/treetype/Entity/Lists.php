<?php

namespace treetype\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lists
 *
 * @ORM\Table(name="lists")
 * @ORM\Entity
 */
class Lists
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lists_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="identify", type="integer", nullable=true)
     */
    private $identify;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=50, nullable=true)
     */
    private $value;



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
     * Set name
     *
     * @param string $name
     * @return Lists
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set identify
     *
     * @param integer $identify
     * @return Lists
     */
    public function setIdentify($identify)
    {
        $this->identify = $identify;

        return $this;
    }

    /**
     * Get identify
     *
     * @return integer 
     */
    public function getIdentify()
    {
        return $this->identify;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return Lists
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }
}
