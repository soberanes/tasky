<?php

namespace Core;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface {

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'core_model_tasksMapper' => function($sm) {
                    $mapper = new Model\TasksMapper();
                    $mapper->setDbAdapter($sm->get('db'));
                    $mapper->setEntityPrototype(new Model\Entity\Tasks());
                    $mapper->setHydrator(new Model\AbstractHydrator('\Core\Model\Entity\TasksInterface'));
                    return $mapper;
                },
            ),
        );
    }

}