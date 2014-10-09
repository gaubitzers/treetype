<?php
namespace treetype\Form;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;

class PopulationForm extends Form
{

    public function __construct (ObjectManager $objectManager)
    {
        parent::__construct('population');
        
        // The form will hydrate an object of type "BlogPost"
        $this->setHydrator(
                new DoctrineHydrator($objectManager, 
                        '\treetype\Entity\Population'));
        
        // Add the user fieldset, and set it as the base fieldset
        $populationFieldset = new PopulationFieldset($objectManager);
        $populationFieldset->setUseAsBaseFieldset(true);
        $this->add($populationFieldset);
        
        $this->add(
                array(
                        'name' => 'submit',
                        'type' => 'Submit',
                        'attributes' => array(
                                'value' => 'Add population',
                                'id' => 'submitbutton'
                        )
                ));
        
        // Optionally set your validation group here
    }
}