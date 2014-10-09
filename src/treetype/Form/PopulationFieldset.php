<?php
namespace treetype\Form;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use treetype\Entity\Population;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class PopulationFieldset extends Fieldset implements 
        InputFilterProviderInterface
{

    public function __construct (ObjectManager $objectManager)
    {
        parent::__construct('population');
        
        $this->setHydrator(
                new DoctrineHydrator($objectManager, 
                        '\treetype\Entity\Population'))->setObject(
                new Population());
        
        $this->add(
                array(
                        'name' => 'id',
                        'type' => 'Hidden'
                ));
        
        $this->add(
                array(
                        'name' => 'name',
                        'type' => 'Text',
                        'options' => array(
                                'label' => 'Population name'
                        )
                ));
        $this->add(
                array(
                        'type' => 'DoctrineModule\Form\Element\ObjectSelect',
                        'name' => 'type',
                        'options' => array(
                                'label' => 'Type of Population',
                                'object_manager' => $objectManager,
                                'empty_option' => '--- please choose ---',
                                'target_class' => 'treetype\Entity\Lists',
                                'property' => 'value',
                                // 'is_method' => false,
                                'find_method' => array(
                                        'name' => 'findBy',
                                        'params' => array(
                                                'criteria' => array(
                                                        'name' => 'population_type'
                                                )
                                        )
                                )
                        )
                ));
        
        $this->add(
                array(
                        'name' => 'description',
                        'type' => 'Textarea',
                        'options' => array(
                                'label' => 'Population description'
                        ),
                        'attributes' => array(
                                'cols' => '50',
                                'rows' => '10'
                        )
                ));
    }

    public function getInputFilterSpecification ()
    {
        return array(
                'id' => array(
                        'required' => false
                ),
                
                'name' => array(
                        'required' => true
                ),
                'type' => array(
                        'required' => false
                ),
                'description' => array(
                        'required' => false
                )
        );
    }
}

