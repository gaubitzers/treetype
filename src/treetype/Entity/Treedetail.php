<?php

namespace treetype\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Treedetail
 *
 * @ORM\Table(name="treedetail", indexes={@ORM\Index(name="IDX_B6757BF878B64A2", columns={"tree_id"})})
 * @ORM\Entity
 */
class Treedetail
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="treedetail_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="diam13", type="float", precision=10, scale=0, nullable=true)
     */
    private $diam13;

    /**
     * @var float
     *
     * @ORM\Column(name="height", type="float", precision=10, scale=0, nullable=true)
     */
    private $height;

    /**
     * @var float
     *
     * @ORM\Column(name="crownsize", type="float", precision=10, scale=0, nullable=true)
     */
    private $crownsize;

    /**
     * @var string
     *
     * @ORM\Column(name="stemform", type="string", length=100, nullable=true)
     */
    private $stemform;

    /**
     * @var float
     *
     * @ORM\Column(name="barkthickness", type="float", precision=10, scale=0, nullable=true)
     */
    private $barkthickness;

    /**
     * @var integer
     *
     * @ORM\Column(name="numberoffruits", type="integer", nullable=true)
     */
    private $numberoffruits;

    /**
     * @var float
     *
     * @ORM\Column(name="seedmass", type="float", precision=10, scale=0, nullable=true)
     */
    private $seedmass;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="firstflowering", type="date", nullable=true)
     */
    private $firstflowering;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="budflush", type="date", nullable=true)
     */
    private $budflush;

    /**
     * @var float
     *
     * @ORM\Column(name="specificleafarea", type="float", precision=10, scale=0, nullable=true)
     */
    private $specificleafarea;

    /**
     * @var float
     *
     * @ORM\Column(name="leafdamage", type="float", precision=10, scale=0, nullable=true)
     */
    private $leafdamage;

    /**
     * @var \treetype\Entity\Tree
     *
     * @ORM\ManyToOne(targetEntity="treetype\Entity\Tree")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tree_id", referencedColumnName="id")
     * })
     */
    private $tree;


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
     * Set date
     *
     * @param \DateTime $date
     * @return Treedetail
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set diam13
     *
     * @param float $diam13
     * @return Treedetail
     */
    public function setDiam13($diam13)
    {
        $this->diam13 = $diam13;

        return $this;
    }

    /**
     * Get diam13
     *
     * @return float 
     */
    public function getDiam13()
    {
        return $this->diam13;
    }

    /**
     * Set height
     *
     * @param float $height
     * @return Treedetail
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return float 
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set crownsize
     *
     * @param float $crownsize
     * @return Treedetail
     */
    public function setCrownsize($crownsize)
    {
        $this->crownsize = $crownsize;

        return $this;
    }

    /**
     * Get crownsize
     *
     * @return float 
     */
    public function getCrownsize()
    {
        return $this->crownsize;
    }

    /**
     * Set stemform
     *
     * @param string $stemform
     * @return Treedetail
     */
    public function setStemform($stemform)
    {
        $this->stemform = $stemform;

        return $this;
    }

    /**
     * Get stemform
     *
     * @return string 
     */
    public function getStemform()
    {
        return $this->stemform;
    }

    /**
     * Set barkthickness
     *
     * @param float $barkthickness
     * @return Treedetail
     */
    public function setBarkthickness($barkthickness)
    {
        $this->barkthickness = $barkthickness;

        return $this;
    }

    /**
     * Get barkthickness
     *
     * @return float 
     */
    public function getBarkthickness()
    {
        return $this->barkthickness;
    }

    /**
     * Set numberoffruits
     *
     * @param integer $numberoffruits
     * @return Treedetail
     */
    public function setNumberoffruits($numberoffruits)
    {
        $this->numberoffruits = $numberoffruits;

        return $this;
    }

    /**
     * Get numberoffruits
     *
     * @return integer 
     */
    public function getNumberoffruits()
    {
        return $this->numberoffruits;
    }

    /**
     * Set seedmass
     *
     * @param float $seedmass
     * @return Treedetail
     */
    public function setSeedmass($seedmass)
    {
        $this->seedmass = $seedmass;

        return $this;
    }

    /**
     * Get seedmass
     *
     * @return float 
     */
    public function getSeedmass()
    {
        return $this->seedmass;
    }

    /**
     * Set firstflowering
     *
     * @param \DateTime $firstflowering
     * @return Treedetail
     */
    public function setFirstflowering($firstflowering)
    {
        $this->firstflowering = $firstflowering;

        return $this;
    }

    /**
     * Get firstflowering
     *
     * @return \DateTime 
     */
    public function getFirstflowering()
    {
        return $this->firstflowering;
    }

    /**
     * Set budflush
     *
     * @param \DateTime $budflush
     * @return Treedetail
     */
    public function setBudflush($budflush)
    {
        $this->budflush = $budflush;

        return $this;
    }

    /**
     * Get budflush
     *
     * @return \DateTime 
     */
    public function getBudflush()
    {
        return $this->budflush;
    }

    /**
     * Set specificleafarea
     *
     * @param float $specificleafarea
     * @return Treedetail
     */
    public function setSpecificleafarea($specificleafarea)
    {
        $this->specificleafarea = $specificleafarea;

        return $this;
    }

    /**
     * Get specificleafarea
     *
     * @return float 
     */
    public function getSpecificleafarea()
    {
        return $this->specificleafarea;
    }

    /**
     * Set leafdamage
     *
     * @param float $leafdamage
     * @return Treedetail
     */
    public function setLeafdamage($leafdamage)
    {
        $this->leafdamage = $leafdamage;

        return $this;
    }

    /**
     * Get leafdamage
     *
     * @return float 
     */
    public function getLeafdamage()
    {
        return $this->leafdamage;
    }

     /**
     * Set tree
     *
     * @param \treetype\Entity\Tree $tree
     * @return Tree
     */
    public function setTree(\treetype\Entity\Tree $tree = null)
    {
        $this->tree = $tree;

        return $this;
    }

    /**
     * Get tree
     *
     * @return \treetype\Entity\Tree 
     */
    public function getTree()
    {
        return $this->tree;
    }
}
