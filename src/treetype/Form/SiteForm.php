<?php
namespace treetype\Form;
use Zend\Form\Form;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class SiteForm extends Form
{

    public function __construct (ObjectManager $objectManager)
    {
        parent::__construct('site');
        // The form will hydrate an object of type "Site"
        $this->setHydrator(
                new DoctrineHydrator($objectManager, '\treetype\Entity\Site'));
        
        // Add the site fieldset, and set it as the base fieldset
        
        $geoFieldset = new GeoFieldset($objectManager);
        
        $siteFieldset = new SiteFieldset($objectManager);
        $siteFieldset->setUseAsBaseFieldset(true)->add($geoFieldset);
        
        $this->add($siteFieldset);
        
        $this->add(
                array(
                        'name' => 'submit',
                        'type' => 'Submit',
                        'attributes' => array(
                                'value' => 'Add site',
                                'id' => 'submitbutton'
                        )
                ));
    }
}