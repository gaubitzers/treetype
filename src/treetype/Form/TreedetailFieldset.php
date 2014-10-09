<?php
namespace treetype\Form;
use treetype\Entity\Treedetail;
use Zend\Form\Fieldset;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\ServiceManager\ServiceManager;
use Zend\InputFilter\InputFilterProviderInterface;

class TreedetailFieldset extends Fieldset implements InputFilterProviderInterface
{

    function __construct (ObjectManager $objectManager)
    
    {
        parent::__construct('treedetail');
        
        $this->setHydrator(
                new DoctrineHydrator($objectManager, '\treetype\Entity\Treedetail'));
        
        $this->setObject(new Treedetail());
        
        $this->setLabel('Treedetail');
        
        $this->add(
                array(
                        'name' => 'id',
                        'type' => 'Hidden'
                ));
        
        $this->add(
                array(
                        'name' => 'date',
                        'type' => 'Date',
                        'options' => array(
                                'label' => 'Date of record'
                        ),
                        'attributes' => array(
                                'class' => 'form-control'
                        )
                ));
        
        $this->add(
                array(
                        'name' => 'diam13',
                        // 'type' => 'Number',
                        'options' => array(
                                'label' => 'Diameter at 1.3m'
                        ),
                        'attributes' => array(
                                'class' => 'form-control'
                        )
                                ));
        
        $this->add(
                array(
                        'name' => 'height',
                        'type' => 'Number',
                        'required' => 'false',
                        'options' => array(
                                'label' => 'Height'
                        ),
                        'attributes' => array(
                                'class' => 'form-control'
                        )
                ));
        
        $this->add(
                array(
                        'name' => 'crownsize',
                        'type' => 'Number',
                        'required' => 'false',
                        'options' => array(
                                'label' => 'Crown size'
                        ),
                        'attributes' => array(
                                'class' => 'form-control'
                        )
                ));
        
        $this->add(
                array(
                        'name' => 'stemform',
                        'type' => 'Text',
                        'required' => 'false',
                        'options' => array(
                                'label' => 'Stem form'
                        ),
                        'attributes' => array(
                                'class' => 'form-control'
                        )
                ));
        
        $this->add(
                array(
                        'name' => 'barkthickness',
                        'type' => 'Number',
                        'required' => 'false',
                        'options' => array(
                                'label' => 'Bark thickness'
                        ),
                        'attributes' => array(
                                'class' => 'form-control'
                        )
                ));
        
        $this->add(
                array(
                        'name' => 'numberoffruits',
                        'type' => 'Number',
                        'options' => array(
                                'label' => 'Number of fruits'
                        ),
                        'attributes' => array(
                                'class' => 'form-control'
                        )
                ));
        
        $this->add(
                array(
                        'name' => 'seedmass',
                        'type' => 'Number',
                        'options' => array(
                                'label' => 'Seed mass'
                        ),
                        'attributes' => array(
                                'class' => 'form-control'
                        )
                ));
        
        $this->add(
                array(
                        'name' => 'firstflowering',
                        'type' => 'Date',
                        'options' => array(
                                'label' => 'First flowering Date'
                        ),
                        'attributes' => array(
                                'class' => 'form-control'
                        )
                ));
        
        $this->add(
                array(
                        'name' => 'budflush',
                        'type' => 'Date',
                        'options' => array(
                                'label' => 'Bud flush date'
                        ),
                        'attributes' => array(
                                'class' => 'form-control'
                        )
                ));
        
        $this->add(
                array(
                        'name' => 'specificleafarea',
                        'type' => 'Number',
                        'options' => array(
                                'label' => 'Specific leaf area'
                        ),
                        'attributes' => array(
                                'class' => 'form-control'
                        )
                ));
        
        $this->add(
                array(
                        'name' => 'leafdamage',
                        'type' => 'Number',
                        'options' => array(
                                'label' => 'Leaf damage'
                        ),
                        'attributes' => array(
                                'class' => 'form-control'
                        )
                ));
        
    } 
    
    public function getInputFilterSpecification ()
    {
        return array(
                'date' => array(
                        'required' => true
                ),
                'diam13' => array(
                        'required' => false,
                        'filters' => array(
                                array(
                                        'name' => 'Int'
                                ),
                                array(
                                        'name' => 'Null',
                                        'options' => array(
                                                'type' => 'all'
                                        )
                                )
                        )
                ),
                'height' => array(
                        'required' => false,
                        'validators' => array(
                                array(
                                        'name' => 'Float'
                                )
                        ),
                        'filters' => array(
                                array(
                                        'name' => 'Null'
                                )
                        )
                ),
                'crownsize' => array(
                        'required' => false,
                        'validators' => array(
                                array(
                                        'name' => 'Float'
                                )
                        ),
                        'filters' => array(
                                array(
                                        'name' => 'Null'
                                )
                        )
                ),
                'stemform' => array(
                        'required' => false
                ),
                'barkthickness' => array(
                        'required' => false,
                        'validators' => array(
                                array(
                                        'name' => 'Float'
                                )
                        ),
                        'filters' => array(
                                array(
                                        'name' => 'Null'
                                )
                        )
                ),
                'numberoffruits' => array(
                        'required' => false,
                        'validators' => array(
                                array(
                                        'name' => 'Step'
                                )
                        ),
                        'filters' => array(
                                array(
                                        'name' => 'Null'
                                )
                        )
                ),
                'seedmass' => array(
                        'required' => false,
                        'validators' => array(
                                array(
                                        'name' => 'Float'
                                )
                        ),
                        'filters' => array(
                                array(
                                        'name' => 'Null'
                                )
                        )
                ),
                'firstflowering' => array(
                        'required' => false,
                        'validators' => array(
                                array(
                                        'name' => 'Date'
                                )
                        ),
                        'filters' => array(
                                array(
                                        'name' => 'Null'
                                )
                        )
                ),
                'budflush' => array(
                        'required' => false,
                        'validators' => array(
                                array(
                                        'name' => 'Date'
                                )
                        ),
                        'filters' => array(
                                array(
                                        'name' => 'Null'
                                )
                        )
                ),
                'specificleafarea' => array(
                        'required' => false,
                        'validators' => array(
                                array(
                                        'name' => 'Float'
                                )
                                
                        ),
                        'filters' => array(
                                array(
                                        'name' => 'Null'
                                )
                        )
                ),
                'leafdamage' => array(
                        'required' => false,
                        'validators' => array(
                                array(
                                        'name' => 'Float'
                                )
                        ),
                        'filters' => array(
                                array(
                                        'name' => 'Null'
                                )
                        )
                )
        );
    }
}