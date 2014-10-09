<?php
namespace treetype;
return array(
        'controllers' => array(
                'invokables' => array(
                        'treetype\Controller\treetype' => 'treetype\Controller\TreetypeController',
                        'treetype\Controller\tree' => 'treetype\Controller\TreeController',
                        'treetype\Controller\site' => 'treetype\Controller\SiteController',
                        'treetype\Controller\population' => 'treetype\Controller\PopulationController'
                ),
                                
        ),           
        'router' => array(
                'routes' => array(
                        'tree' => array(
                                'type' => 'segment',
                                'options' => array(
                                        'route' => '/tree[/][:action][/:id]',
                                        'constraints' => array(
                                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                'id' => '[0-9]+'
                                        ),
                                        'defaults' => array(
                                                'controller' => 'treetype\Controller\tree',
                                                'action' => 'list'
                                        )
                                )
                        ),
                        'treetype' => array(
                                'type' => 'segment',
                                'options' => array(
                                        'route' => '/treetype[/][:action]',
                                        'constraints' => array(
                                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                                        ),
                                        'defaults' => array(
                                                'controller' => 'treetype\Controller\treetype',
                                                'action' => 'index'
                                        )
                                )
                        ),
                        'site' => array(
                                'type' => 'segment',
                                'options' => array(
                                        'route' => '/site[/][:action][/:id]',
                                        'constraints' => array(
                                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                'id' => '[0-9]+'
                                        ),
                                        'defaults' => array(
                                                'controller' => 'treetype\Controller\site',
                                                'action' => 'list'
                                        )
                                )
                        ),
                        'population' => array(
                                'type' => 'segment',
                                'options' => array(
                                        'route' => '/population[/][:action][/:id]',
                                        'constraints' => array(
                                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                                'id' => '[0-9]+'
                                        ),
                                        'defaults' => array(
                                                'controller' => 'treetype\Controller\population',
                                                'action' => 'list'
                                        )
                                )
                        )
                )
        ),
        'doctrine' => array(
                'driver' => array(
                        __NAMESPACE__ . '_driver' => array(
                                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                                'cache' => 'array',
                                'paths' => array(
                                        __DIR__ . '/../src/' . __NAMESPACE__ .
                                                 '/Entity'
                                )
                        ),
                        
                        'orm_default' => array(
                                'drivers' => array(
                                        __NAMESPACE__ . '\Entity' => __NAMESPACE__ .
                                         '_driver'
                                )
                        )
                ),
                'connection' => array(
                        'orm_default' => array(
                                'doctrine_type_mappings' => array(
                                        'bit' => 'string'
                                )
                        )
                )
        ),
        'view_helpers' => array(
                'factories' => array(
                        'Requesthelper' => 'treetype\View\Helper\Factory\RequestHelperFactory',
                )
        ),
        'view_manager' => array(
                'template_map' => array(
                        'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
                        'treetype/index/index' => __DIR__ . '/../view/treetype/index/index.phtml',
                        'error/404'               => __DIR__ . '/../view/error/404.phtml',
                        'error/index'             => __DIR__ . '/../view/error/index.phtml',
                ),
                'template_path_stack' => array(
                        'treetype' => __DIR__ . '/../view'
                )
        ),
);
