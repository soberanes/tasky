<?php
namespace Tasks\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;

class TaskApi implements ServiceManagerAwareInterface
{
    /**
     * @var ServiceManager
     */
    protected $serviceManager;

     /**
     * Get Service Manager
     * 
     * @return type
     */
    public function getServiceManager(){
        return $this->serviceManager;
    }

    /**
     * Inject Service Manager
     * 
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     * @return \Zend\ServiceManager\ServiceManager
     */
    public function setServiceManager(ServiceManager $serviceManager){
        $this->serviceManager = $serviceManager;
        return $this;
    }

    protected function getMapper(){
        $mapper = $this->getServiceManager()->get('core_model_tasksMapper');
        return $mapper;
    }

    private function serializeMap($map){
        $serial_map = array();
        
        foreach ($map as $key => $value) {
            $serial_map[$key] = $value;
        }

        return $serial_map;
    }

    public function getEntityMap($collection){
        $entities = array();

        $serial_map = $this->serializeMap($collection);

        foreach ($serial_map as $key => $task) {
            $entities[$key] = array(
                "task_id" => $task->getTaskId(),
                "title" => $task->getTitle(),
                "description" => $task->getDescription(),
                "cretion_date" => $task->getCreationDate(),
                "last_update" => $task->getLastUpdate(),
                "complete_date" => $task->getCompletedDate(),
                "tag" => $task->getTag(),
                "status" => $task->getStatus(),
            );
        }

        return $entities;
    }

    /**
     * This method returns a list of products
     *
     * @param String $limit
     * @return Array
     */
    public function getTasks($limit = null){
        $mapper = $this->getMapper();
        $tasks = $mapper->fetchAll();
        return $this->getEntityMap($tasks);
    }

    public function getTaskById($task_id){
        $mapper = $this->getMapper();
        $task = $mapper->findByTaskId($task_id);
        return $task;
    }

    public function addRandomTask(){
        $mapper = $this->getMapper();
        $task_generated = $mapper->saveTasks();
        return $task_generated;
    }


}