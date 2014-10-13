<?php
namespace treetype;
use DoctrineORMModule\Service\ConfigurationFactory as ORMConfigurationFactory;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
                'Zend\Loader\StandardAutoloader' => array(
                        'namespaces' => array(
                                __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                        ),
                ),
        );
    }   
    public function getServiceConfig()
    {
        return array(
                'factories' => array(
                        'doctrine.entitymanager.orm_tt'        => new \DoctrineORMModule\Service\EntityManagerFactory('orm_tt'),
                        'doctrine.connection.orm_tt'           => new \DoctrineORMModule\Service\DBALConnectionFactory('orm_tt'),
                        'doctrine.configuration.orm_tt'        => new ORMConfigurationFactory('orm_tt'),
                ),
        );
    
    }
    public function getFormElementConfig()
    {
        return array(
                'initializers' => array(
                        'ObjectManagerInitializer' => function ($element, $formElements) {
                            if ($element instanceof ObjectManagerAwareInterface) {
                                $services      = $formElements->getServiceLocator();
                                $entityManager = $services->get('Doctrine\ORM\EntityManager');
                                $element->setObjectManager($entityManager);
                            }
                        },
                ),
        );
    }
     public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
                'fieldCollection' => 'treetype\View\Helper\FieldCollection',
                'fieldRow' => 'treetype\View\Helper\FieldRow'
            )
        );
    }   
}
