<?php
namespace treetype\Form;
use Zend\Form\Form;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilter;

class TreeForm extends Form
{

    public function __construct (ObjectManager $objectManager)
    {
        parent::__construct('tree');
        
        // The form will hydrate an object of type "Tree"
        $this->setAttribute('method', 'post');
        $this->setHydrator(
                new DoctrineHydrator($objectManager, '\treetype\Entity\Tree'));
        
        $treeFieldset = new TreeFieldset($objectManager);
        $geo = new GeoFieldset($objectManager);
        $siteDetailFieldset = new SiteDetailFieldset($objectManager);
        $siteDetailFieldset->add($geo);
        $treeFieldset->setUseAsBaseFieldset(true);
        $treeFieldset->add($siteDetailFieldset);
        
        $this->add($treeFieldset);
        
        $this->add(
                array(
                        'name' => 'submit',
                        'attributes' => array(
                                'type' => 'submit',
                                'value' => 'Add this tree',
                                'id' => 'submitbutton'
                        )
                ));        
    }
}