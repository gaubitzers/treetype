<?php
namespace treetype\Form;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class TreeFilter extends InputFilter
{

    public function __construct ()
    {
        $this->add(
                array(
                        'name' => 'identifier',
                        'required' => true,
                        'filters' => array(
                                array(
                                        'name' => 'StringTrim'
                                )
                        )                        
                ));
        
        $this->add(
                array(
                        'name' => 'species',
                        'required' => true,
                        'filters' => array(
                                array(
                                        'name' => 'StringTrim'
                                )
                        )
                ));
        
//         $this->add(
//                 array(
//                         'name' => 'population',
//                         'required' => true,
//                         'filters' => array(
//                                 array(
//                                         'name' => 'StringTrim'
//                                 )
//                         )
//                 ));
        
        $this->add(
                array(
                        'name' => 'site',
                        'required' => true,
                        'filters' => array(
                                array(
                                        'name' => 'StringTrim'
                                )
                        )
                ));
    }
}
