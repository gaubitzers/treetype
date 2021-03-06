<?php

namespace treetype\View\Helper\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RequestHelperFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = $serviceLocator->getServiceLocator();

        $helper = new \treetype\View\Helper\Requesthelper;

        $request = $service->get('Request');
        $helper->setRequest($request);

        return $helper;
    }
}