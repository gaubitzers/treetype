<?php
namespace treetype\Form;
use Zend\Form\Element;
use Doctrine\Common\Persistence\ObjectManager;
use treetype\Entity\Tree;
use Zend\Form\Fieldset;
use treetype\Form\TreedetailFieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class TreeFieldset extends Fieldset

{

    public function __construct (ObjectManager $objectManager)
    {
        parent::__construct('tree');
        
        $this->setHydrator(
                new DoctrineHydrator($objectManager, '\treetype\Entity\Tree'))->setObject(
                new Tree());
        
        $this->add(
                array(
                        'name' => 'id',
                        'type' => 'Hidden'
                ));
        
        $this->add(
                array(
                        'name' => 'user',
                        'type' => 'Text',
                ));
        
        $this->add(
                array(
                        'name' => 'image-upload',
                        'type' => 'File',
                        'options' => array(
                                'label' => 'Image upload'
                        ),
                        'attributes' => array(
                                'title' => 'Image from your Tree available? Please upload it!'
                        )

                ));
        
        $this->add(
                array(
                        'name' => 'name',
                        'type' => 'Text',
                        'options' => array(
                                'label' => 'Tree name *'
                        ),
                        'attributes' => array(
                                'class' => 'form-control',
                                'data-placement' => 'right',
                                'title' => 'Choose a name for your tree'
                        )
                ));
        
        $this->add(
                array(
                        'type' => 'DoctrineModule\Form\Element\ObjectSelect',
                        'name' => 'species',
                        'options' => array(
                                'label' => 'Species *',
                                'object_manager' => $objectManager,
                                'target_class' => 'treetype\Entity\Species',
                                'property' => 'species',
                                'empty_option' => '--- please choose ---'
                        ),
                        'attributes' => array(
                                'data-placement' => 'right',
                                'title' => 'Select the tree species'
                            )
                ));
        
        $treedetailfieldset = new TreedetailFieldset($objectManager);
        $this->add(
                array(
                        'type' => 'Zend\Form\Element\Collection',
                        'name' => 'treedetails',
                        'options' => array(
                                'label' => 'Please add tree details for this tree',
                                'count' => 1,
                                'should_create_template' => true,
                                'allow_add' => true,
                                'allow_remove' => true,
                                'target_element' => $treedetailfieldset
                        )
                ));
    }
}
