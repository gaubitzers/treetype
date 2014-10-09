<?php
namespace treetype\Form;
use Doctrine\Common\Persistence\ObjectManager;
use treetype\Entity\Site;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use treetype\Entity\Sitedetail;

class SiteDetailFieldset extends Fieldset implements InputFilterProviderInterface
{

    public function __construct (ObjectManager $objectManager)
    {
        parent::__construct('sitedetail');
        
        $this->setHydrator(
                new DoctrineHydrator($objectManager, '\treetype\Entity\Sitedetail'))->setObject(
                new Sitedetail());
        
        $this->add(
                array(
                        'name' => 'id',
                        'type' => 'Hidden'
                ));

        $this->add(
                array(
                        'name' => 'slope',
                        'type' => 'Number',
                        'options' => array(
                                'label' => 'Slope %'
                        ),
                        'attributes' => array(
                                'min' => '0',
                                'max' => '100',
                                'step' => '1'
                        )
                ));
        $this->add(
                array(
                        'type' => 'DoctrineModule\Form\Element\ObjectSelect',
                        'name' => 'exposure',
                        'options' => array(
                                'label' => 'Exposure',
                                'object_manager' => $objectManager,
                                'empty_option' => '--- please choose ---',
                                'target_class' => 'treetype\Entity\Lists',
                                'property' => 'value',
                                'is_method' => false,
                                'find_method' => array(
                                        'name' => 'findBy',
                                        'params' => array(
                                                'criteria' => array(
                                                        'name' => 'exposure'
                                                )
                                        )
                                )
                        )
                ));
        
        $this->add(
                array(
                        'type' => 'DoctrineModule\Form\Element\ObjectSelect',
                        'name' => 'topography',
                        'options' => array(
                                'label' => 'Topography',
                                'object_manager' => $objectManager,
                                'empty_option' => '--- please choose ---',
                                'target_class' => 'treetype\Entity\Lists',
                                'property' => 'value',
                                'is_method' => false,
                                'find_method' => array(
                                        'name' => 'findBy',
                                        'params' => array(
                                                'criteria' => array(
                                                        'name' => 'topography'
                                                )
                                        )
                                )
                        )
                ));
        
        $this->add(
                array(
                        'type' => 'DoctrineModule\Form\Element\ObjectSelect',
                        'name' => 'competitionidx',
                        'options' => array(
                                'label' => 'Competition Index',
                                'object_manager' => $objectManager,
                                'empty_option' => '--- please choose ---',
                                'target_class' => 'treetype\Entity\Lists',
                                'property' => 'value',
                                'is_method' => false,
                                'find_method' => array(
                                        'name' => 'findBy',
                                        'params' => array(
                                                'criteria' => array(
                                                        'name' => 'competitiion_idx'
                                                )
                                        )
                                )
                        )
                ));
        
        $this->add(
                array(
                        'name' => 'covplantgt50',
                        'type' => 'Number',
                        'options' => array(
                                'label' => '% coverage plants >50cm'
                        ),
                        'attributes' => array(
                                'min' => '0',
                                'max' => '100',
                                'step' => '1'
                        )
                ));
        
        $this->add(
                array(
                        'name' => 'covplant20to50',
                        'type' => 'Number',
                        'options' => array(
                                'label' => '% coverage plants 20-50cm'
                        ),
                        'attributes' => array(
                                'min' => '0',
                                'max' => '100',
                                'step' => '1'
                        )
                ));
        
        $this->add(
                array(
                        'name' => 'covplantlt20',
                        'type' => 'Number',
                        'options' => array(
                                'label' => '% coverage plants <20cm'
                        ),
                        'attributes' => array(
                                'min' => '0',
                                'max' => '100',
                                'step' => '1'
                        )
                ));
        
        $this->add(
                array(
                        'name' => 'rocks',
                        'type' => 'Text',
                        'options' => array(
                                'label' => 'Rocks'
                        )
                ));
        
        $this->add(
                array(
                        'name' => 'soil',
                        'type' => 'Text',
                        'options' => array(
                                'label' => 'Soil'
                        )
                ));

        $this->add(
                array(
                        'name' => 'description',
                        'type' => 'Textarea',
                        'options' => array(
                                'label' => 'Additional Information'
                            ),
                            'attributes' => array(
                                'cols' => '50',
                                'rows' => '10'
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
                'slope' => array(
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
                'exposure' => array(
                        'required' => false,
                        'filters' => array(
                                array(
                                        'name' => 'Null'
                                )
                        )
                ),
                'topography' => array(
                        'required' => false,
                        'filters' => array(
                                array(
                                        'name' => 'Null'
                                )
                        )
                ),
                'competitionidx' => array(
                        'required' => false,
                        'filters' => array(
                                array(
                                        'name' => 'Null'
                                )
                        )
                ),
                'covplantgt50' => array(
                        'required' => false,
                        'filters' => array(
                                array(
                                        'name' => 'Null'
                                )
                        )
                ),
                'covplant20to50' => array(
                        'required' => false,
                        'filters' => array(
                                array(
                                        'name' => 'Null'
                                )
                        )
                ),
                'covplantlt20' => array(
                        'required' => false,
                        'filters' => array(
                                array(
                                        'name' => 'Null'
                                )
                        )
                ),
                'rocks' => array(
                        'required' => false,
                        'filters' => array(
                                array(
                                        'name' => 'Null'
                                )
                        )
                ),
                'soil' => array(
                        'required' => false,
                        'filters' => array(
                                array(
                                        'name' => 'Null'
                                )
                        )
                ),
                'description' => array(
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
