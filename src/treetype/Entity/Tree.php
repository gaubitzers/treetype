<?php

namespace treetype\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Tree
 *
 * @ORM\Table(name="tree", indexes={@ORM\Index(name="IDX_B73E5EDCB2A1D860", columns={"species_id"}), @ORM\Index(name="IDX_B73E5EDCA76ED395", columns={"user_id"})})
 * @ORM\Entity
 */
class Tree
{
    
    public function __construct() {
        $this->treedetails = new ArrayCollection();
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="tree_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @var \treetype\Entity\Species
     *
     * @ORM\ManyToOne(targetEntity="treetype\Entity\Species")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="species_id", referencedColumnName="id")
     * })
     */
    private $species;

    /**
     * @var \treetype\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="treetype\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $user;
    
    /**
     * @var \treetype\Entity\Sitedetail
     *
     * @ORM\ManyToOne(targetEntity="treetype\Entity\Sitedetail", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sitedetail_id", referencedColumnName="id")
     * })
     */
    private $sitedetail;

    /**
     * @var \treetype\Entity\Treedetail
     *
     * @ORM\OneToMany(targetEntity="treetype\Entity\Treedetail", mappedBy="tree", cascade={"persist", "remove"})
     * 
     */
    protected $treedetails;
    
        /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=100, nullable=true)
     */
    private $image;

    
    public function addtreedetails(Collection $treedetails) {
        foreach ($treedetails as $treedetail) {
            $treedetail->setTree($this);
            $this->treedetails->add($treedetail);
        }
    }
    
    public function removetreedetails(Collection $treedetails)
    {
        foreach ($treedetails as $treedetail) {
            $treedetail->setTree(null);
            $this->treedetails->removeElement($treedetail);
        }
    }
    /**
     * @return array
     */
    public function getTreedetails()
    {
        return $this->treedetails;
    }

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
     * @return Tree
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
     * Set species
     *
     * @param \treetype\Entity\Species $species
     * @return Tree
     */
    public function setSpecies(\treetype\Entity\Species $species = null)
    {
        $this->species = $species;

        return $this;
    }

    /**
     * Get species
     *
     * @return \treetype\Entity\Species 
     */
    public function getSpecies()
    {
        return $this->species;
    }

    /**
     * Set user
     *
     * @param \treetype\Entity\User $user
     * @return Tree
     */
    public function setUser(\treetype\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \treetype\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /**
     * Set sitedetail
     *
     * @param \treetype\Entity\Sitedetail $sitedetail
     * @return Tree
     */
    public function setSitedetail(\treetype\Entity\Sitedetail $sitedetail = null)
    {
        $this->sitedetail = $sitedetail;
    
        return $this;
    }
    
    /**
     * Get sitedetail
     *
     * @return \treetype\Entity\Sitedetail
     */
    public function getSitedetail()
    {
        return $this->sitedetail;
    }
    
    /**
     * Set image
     *
     * @param string $image
     * @return Treedetail
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }
    
    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }    
}
