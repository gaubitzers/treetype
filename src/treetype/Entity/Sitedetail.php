<?php

namespace treetype\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sitedetail
 *
 * @ORM\Table(name="sitedetail", indexes={@ORM\Index(name="IDX_FBBB425678B64A2", columns={"tree_id"}), @ORM\Index(name="IDX_FBBB4256FA49D0B", columns={"geo_id"})})
 * @ORM\Entity
 */
class Sitedetail
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="sitedetail_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="slope", type="float", precision=10, scale=0, nullable=true)
     */
    private $slope;

    /**
     * @var integer
     *
     * @ORM\Column(name="exposure", type="integer", nullable=true)
     */
    private $exposure;

    /**
     * @var integer
     *
     * @ORM\Column(name="topography", type="integer", nullable=true)
     */
    private $topography;

    /**
     * @var integer
     *
     * @ORM\Column(name="competition_idx", type="integer", nullable=true)
     */
    private $competitionIdx;

    /**
     * @var float
     *
     * @ORM\Column(name="covplantgt", type="float", precision=10, scale=0, nullable=true)
     */
    private $covplantgt;

    /**
     * @var float
     *
     * @ORM\Column(name="covplant20to50", type="float", precision=10, scale=0, nullable=true)
     */
    private $covplant20to50;

    /**
     * @var float
     *
     * @ORM\Column(name="covplantlt20", type="float", precision=10, scale=0, nullable=true)
     */
    private $covplantlt20;

    /**
     * @var string
     *
     * @ORM\Column(name="rocks", type="string", length=100, nullable=true)
     */
    private $rocks;

    /**
     * @var string
     *
     * @ORM\Column(name="soil", type="string", length=100, nullable=true)
     */
    private $soil;

    /**
     * @var string
     *
     * @ORM\Column(name="popname", type="string", length=100, nullable=true)
     */
    private $popname;

    /**
     * @var integer
     *
     * @ORM\Column(name="sitetype", type="bigint", nullable=true)
     */
    private $sitetype;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500, nullable=true)
     */
    private $description;

    /**
     * @var \treetype\Entity\Geo
     *
     * @ORM\ManyToOne(targetEntity="treetype\Entity\Geo", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="geo_id", referencedColumnName="id")
     * })
     */
    private $geo;

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
     * Set slope
     *
     * @param float $slope
     * @return Sitedetail
     */
    public function setSlope($slope)
    {
        $this->slope = $slope;

        return $this;
    }

    /**
     * Get slope
     *
     * @return float 
     */
    public function getSlope()
    {
        return $this->slope;
    }

    /**
     * Set exposure
     *
     * @param integer $exposure
     * @return Sitedetail
     */
    public function setExposure($exposure)
    {
        $this->exposure = $exposure;

        return $this;
    }

    /**
     * Get exposure
     *
     * @return integer 
     */
    public function getExposure()
    {
        return $this->exposure;
    }

    /**
     * Set topography
     *
     * @param integer $topography
     * @return Sitedetail
     */
    public function setTopography($topography)
    {
        $this->topography = $topography;

        return $this;
    }

    /**
     * Get topography
     *
     * @return integer 
     */
    public function getTopography()
    {
        return $this->topography;
    }

    /**
     * Set competitionIdx
     *
     * @param integer $competitionIdx
     * @return Sitedetail
     */
    public function setCompetitionIdx($competitionIdx)
    {
        $this->competitionIdx = $competitionIdx;

        return $this;
    }

    /**
     * Get competitionIdx
     *
     * @return integer 
     */
    public function getCompetitionIdx()
    {
        return $this->competitionIdx;
    }

    /**
     * Set covplantgt
     *
     * @param float $covplantgt
     * @return Sitedetail
     */
    public function setCovplantgt($covplantgt)
    {
        $this->covplantgt = $covplantgt;

        return $this;
    }

    /**
     * Get covplantgt
     *
     * @return float 
     */
    public function getCovplantgt()
    {
        return $this->covplantgt;
    }

    /**
     * Set covplant20to50
     *
     * @param float $covplant20to50
     * @return Sitedetail
     */
    public function setCovplant20to50($covplant20to50)
    {
        $this->covplant20to50 = $covplant20to50;

        return $this;
    }

    /**
     * Get covplant20to50
     *
     * @return float 
     */
    public function getCovplant20to50()
    {
        return $this->covplant20to50;
    }

    /**
     * Set covplantlt20
     *
     * @param float $covplantlt20
     * @return Sitedetail
     */
    public function setCovplantlt20($covplantlt20)
    {
        $this->covplantlt20 = $covplantlt20;

        return $this;
    }

    /**
     * Get covplantlt20
     *
     * @return float 
     */
    public function getCovplantlt20()
    {
        return $this->covplantlt20;
    }

    /**
     * Set rocks
     *
     * @param string $rocks
     * @return Sitedetail
     */
    public function setRocks($rocks)
    {
        $this->rocks = $rocks;

        return $this;
    }

    /**
     * Get rocks
     *
     * @return string 
     */
    public function getRocks()
    {
        return $this->rocks;
    }

    /**
     * Set soil
     *
     * @param string $soil
     * @return Sitedetail
     */
    public function setSoil($soil)
    {
        $this->soil = $soil;

        return $this;
    }

    /**
     * Get soil
     *
     * @return string 
     */
    public function getSoil()
    {
        return $this->soil;
    }

    /**
     * Set popname
     *
     * @param string $popname
     * @return Sitedetail
     */
    public function setPopname($popname)
    {
        $this->popname = $popname;

        return $this;
    }

    /**
     * Get popname
     *
     * @return string 
     */
    public function getPopname()
    {
        return $this->popname;
    }

    /**
     * Set sitetype
     *
     * @param integer $sitetype
     * @return Sitedetail
     */
    public function setSitetype($sitetype)
    {
        $this->sitetype = $sitetype;

        return $this;
    }

    /**
     * Get sitetype
     *
     * @return integer 
     */
    public function getSitetype()
    {
        return $this->sitetype;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Sitedetail
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * Set geo
     *
     * @param \treetype\Entity\Geo $geo
     * @return Sitedetail
     */
    public function setGeo(\treetype\Entity\Geo $geo = null)
    {
        $this->geo = $geo;

        return $this;
    }

    /**
     * Get geo
     *
     * @return \treetype\Entity\Geo 
     */
    public function getGeo()
    {
        return $this->geo;
    }
}
