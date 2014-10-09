<?php
namespace treetype\Form;
use Zend\Form\Form;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class CollectionForm extends Form
{

    public function __construct (ObjectManager $objectManager)
    {
        parent::__construct('create_product');
        
        $this->setAttribute('method', 'post')
            ->setHydrator(new ClassMethodsHydrator(false))
            ->setInputFilter(new InputFilter());
        
        $treeFieldset = new TreeFieldset($objectManager);
        $treeFieldset->setUseAsBaseFieldset(true);
        
        $this->add($treeFieldset);
        
        
        $this->add(
                array(
                        'name' => 'submit',
                        'attributes' => array(
                                'type' => 'submit',
                                'value' => 'Send'
                        )
                ));
    }
}
