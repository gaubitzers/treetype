<?php
namespace treetype\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use treetype\Entity\Sitedetail;
use treetype\Entity\Treedetail;

class TreetypeController extends AbstractActionController
{

    protected $entityManager;
    
    public function contactAction ()
    {
        return new ViewModel();
    }
    
    public function voteAction ()
    {
        return new ViewModel();
    }
    
    public function aboutAction ()
    {
        return new ViewModel();
    }
    
    public function indexAction ()
    {
        
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT t, sd, g FROM treetype\Entity\Tree t JOIN t.sitedetail sd JOIN sd.geo g where g.latitude is not null and g.longitude is not null");
        $trees = $query->getResult();
        $markers = array();
        $centerlat = 47.753168;
        $centerlong = 1.672218;
        foreach ($trees as $tree) {
            $geo = $tree->getSitedetail()->getGeo();
            $id = $tree->getId();
            $markers[$tree->getName()]['geo'] = $geo->getLatitude() .','. $geo->getLongitude();        	
            $markers[$tree->getName()]['id'] = $id;
        }    

        $config = array(
            'sensor' => 'true',         //true or false
            'div_id' => 'map',          //div id of the google map
            'div_class' => 'grid_6',    //div class of the google map
            'zoom' => 5,                //zoom level
            'width' => "500px",         //width of the div
            'height' => "300px",        //height of the div
            'lat' => 16.916684,         //lattitude
            'lon' => 80.683594,         //longitude 
            'animation' => 'bounce',      //animation of the marker
            'markers' => $markers       //loading the array of markers
        );

        $map = $this->getServiceLocator()->get('GMaps\Service\GoogleMap'); //getting the google map object using service manager
        $map->initialize($config);                                         //loading the config   
        //$html = $map->generateSimpleMap();                             //genrating the html map content
        $html = $map->generateIndexMap();                             //genrating the html map content
          
        $query = $em->createQuery(
                'SELECT count(t.id) FROM treetype\Entity\Tree t');
        $treecount = $query->getResult();
        
        
        $query = $em->createQuery(
                'SELECT
                    SUM(((CASE WHEN td.diam13 IS NULL THEN 0 ELSE 1 END)
                    + (CASE WHEN td.height IS NULL THEN 0 ELSE 1 END)
                    + (CASE WHEN td.crownsize IS NULL THEN 0 ELSE 1 END)
                    + (CASE WHEN (td.stemform IS NULL or td.stemform = \'\') THEN 0 ELSE 1 END)
                    + (CASE WHEN td.barkthickness IS NULL THEN 0 ELSE 1 END)
                    + (CASE WHEN td.numberoffruits IS NULL THEN 0 ELSE 1 END)
                    + (CASE WHEN td.seedmass IS NULL THEN 0 ELSE 1 END)
                    + (CASE WHEN td.firstflowering IS NULL THEN 0 ELSE 1 END)
                    + (CASE WHEN td.budflush IS NULL THEN 0 ELSE 1 END)
                    + (CASE WHEN td.specificleafarea IS NULL THEN 0 ELSE 1 END)
                    + (CASE WHEN td.leafdamage IS NULL THEN 0 ELSE 1 END)
                    )) AS sum_of_measurements
                FROM treetype\Entity\Treedetail td');
        $measurements = $query->getResult();
        
        $query = $em->createQuery(
                'SELECT t FROM treetype\Entity\Tree t order by t.id desc');
        $query->setMaxResults(6);
        $carousel = $query->getResult();
        
        return new ViewModel(
                array(
                        'map_html' => $html,
                        'treecount' => $treecount[0],
                        'measurements' => $measurements[0],
                        'carousel'  => $carousel
                )); 
    }


    public function mapAction ()
    {
        $markers = array(
            'Mozzat Web Team' => '17.516684,79.961589',
            'Home Town' => '16.916684,80.683594'
        );  //markers location with latitude and longitude

        $config = array(
            'sensor' => 'true',         //true or false
            'div_id' => 'map',          //div id of the google map
            'div_class' => 'grid_6',    //div class of the google map
            'zoom' => 5,                //zoom level
            'width' => "600px",         //width of the div
            'height' => "300px",        //height of the div
            'lat' => 16.916684,         //lattitude
            'lon' => 80.683594,         //longitude 
            'animation' => 'bounce',      //animation of the marker
            'markers' => $markers       //loading the array of markers
        );

        $map = $this->getServiceLocator()->get('GMaps\Service\GoogleMap'); //getting the google map object using service manager
        $map->initialize($config);                                         //loading the config   
        $html = $map->generateTreeMapScript();                             //genrating the html map content
        $api = $map->getGoogleApi();

        

        
        echo $treecount;
        return new ViewModel(
                array(
                        'map_html' => $html,
                        'treecount' => $treecount,
                        'measurements' => $measurements
                ));                  

    }
    
    protected function setEntityManager (\Doctrine\ORM\EntityManager $em)
    {
        $this->entityManager = $em;
        return $this;
    }
    
    protected function getEntityManager ()
    {
        if (null === $this->entityManager) {
            $this->setEntityManager(
                    $this->getServiceLocator()
                    ->get('Doctrine\ORM\EntityManager'));
        }
        return $this->entityManager;
    }
}
