<?php
namespace Tasks\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class TasksController extends AbstractActionController{

	public function indexAction(){
		
		$tasks_api = $this->getServiceLocator()->get('tasks_api');
		$tasks_collection = $tasks_api->getTasks();
		$tasks = array();

		$result = new JsonModel(array(
			"response_code" => 100,
	    	"tasks" => $tasks_collection,
	    	"success" => true
        ));

        return $result;
	}

	public function getAction(){
		$id = (int) $this->params()->fromRoute('id', 0);

		if(!$id){
			return new JsonModel(array(
				"response_code" => 201,
		    	"message" 	 => "NO_ID_RECEIVED",
		    	"success" 	 => false
	        ));
		}

		$tasks_api = $this->getServiceLocator()->get('tasks_api');
		$task = $tasks_api->getTaskById($id);

		return $result = new JsonModel(array(
	    	"response_code" => 100,
	    	"task" 			=> array(
	    		"task_id" 		=> $task->getTaskId(),
                "title" 		=> $task->getTitle(),
                "description" 	=> $task->getDescription(),
                "cretion_date" 	=> $task->getCreationDate(),
                "last_update" 	=> $task->getLastUpdate(),
                "complete_date" => $task->getCompletedDate(),
                "tag" 			=> $task->getTag(),
                "status" 		=> $task->getStatus()
	    	),
	    	"success" 		=> true
        ));
	}

	protected function _predump($arg){
		echo "<pre>";
		var_dump($arg);
		echo "</pre>";
		die;
	}

}