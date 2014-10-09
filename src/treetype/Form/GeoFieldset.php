<?php
namespace treetype\Form;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use treetype\Entity\Geo;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class GeoFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function __construct (ObjectManager $objectManager)
    {
        parent::__construct('geo');
        
        $this->setHydrator(
                new DoctrineHydrator($objectManager, '\treetype\Entity\Geo'))->setObject(
                new Geo());
        
        $this->add(
                array(
                        'name' => 'latitude',
                        'type' => 'Number',
                        'options' => array(
                                'label' => 'Latitude'
                        ),
                        'attributes' => array(
                                'min' => -90,
                                'max' => 90,
                                'step' => 0.000001
                        )
                ));
        
        $this->add(
                array(
                        'name' => 'longitude',
                        'type' => 'Number',
                        'options' => array(
                                'label' => 'Longitude'
                        ),
                        'attributes' => array(
                                'min' => -180,
                                'max' => 180,
                                'step' => 0.000001
                        )
                ));
        
        $this->add(
                array(
                        'name' => 'altitude',
                        'type' => 'Number',
                        'options' => array(
                                'label' => 'Altitude'
                        )
                ));
        
        $this->add(
                array(
                        'type' => 'DoctrineModule\Form\Element\ObjectSelect',
                        'name' => 'country',
                        'options' => array(
                                'label' => 'Country',
                                'object_manager' => $objectManager,
                                'empty_option' => '--- please choose ---',
                                'target_class' => 'treetype\Entity\Country',
                                'property' => 'name'
                        // 'is_method' => false,
                                                )
                ));
        
        $this->add(
                array(
                        'name' => 'region',
                        'type' => 'Text',
                        'options' => array(
                                'label' => 'Region'
                        )
                ));
    }

    /**
     *
     * @return array \
     */
    public function getInputFilterSpecification ()
    {
        return array(
                'latitude' => array(
                        'required' => false,
//                         'validators' => array(
//                                 array(
//                                         //'name' => 'Float',
//                                         'locale' => 'de'
//                                 )
//                         ),
                        'filters' => array(
                                array(
                                        'name' => 'Null'
                                )
                        )
                ),
                'longitude' => array(
                        'required' => false,
//                         'validators' => array(
//                                 array(
//                                        // 'name' => 'Float',
//                                         'locale' => 'de'
//                                 )
//                         ),
                        'filters' => array(
                                array(
                                        'name' => 'Null'
                                )
                        )
                ),
                'altitude' => array(
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
                'country' => array(
                        'required' => true
                ),
                'region' => array(
                        'required' => false,
                        'filters' => array(
                                array(
                                        'name' => 'Null'
                                )
                        )
                )
        );
    }
}