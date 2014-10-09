<?php
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use treetype\Entity\Lists;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class ListsFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function __construct (ObjectManager $objectManager)
    {
        parent::__construct('list');
        
        $this->setHydrator(new DoctrineHydrator($objectManager,'\treetype\Entity\Lists'))->setObject(
                new Lists());
        
        $this->add(
                array(
                        'type' => 'Zend\Form\Element\Hidden',
                        'name' => 'id'
                ));
        
        $this->add(
                array(
                        'type' => 'Zend\Form\Element\Text',
                        'name' => 'value',
                        'options' => array(
                                'label' => 'Type'
                        )
                ));
    }

    public function getInputFilterSpecification ()
    {
        return array(
                'id' => array(
                        'required' => false
                ),
                
                'value' => array(
                        'required' => true
                )
        );
    }
}