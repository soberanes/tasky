<?php
namespace Tasks;

class Module
{

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
                'tasks_api'=> function($sm){
                    $task_api = new \Tasks\Service\TaskApi;
                    $task_api->setServiceManager($sm);
                    return $task_api;
                },
            )
        );
    }

}