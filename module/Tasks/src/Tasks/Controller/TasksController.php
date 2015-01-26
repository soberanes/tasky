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

		$response = new JsonModel(array(
			"response_code" => 100,
			"message" 	 	=> "TASKS_COLLECTION",
	    	"tasks" => $tasks_collection,
	    	"success" => true
        ));

        return $response;
	}

	public function getAction(){
		$request = $this->getRequest();
		if(!$request->isPost()){
			return new JsonModel(array(
				"response_code" => 203,
		    	"message" 	 => "NO_DATA_RECEIVED",
		    	"success" 	 => false
	        ));
		}

		$data = $request->getPost();
		if(!$data['task_id']){
			return new JsonModel(array(
				"response_code" => 201,
		    	"message" 	 => "NO_ID_RECEIVED",
		    	"success" 	 => false
	        ));
		}

		$tasks_api = $this->getServiceLocator()->get('tasks_api');

		try{
			$task = $tasks_api->getTaskById($data['task_id']);
			if($task){
				$response = new JsonModel(array(
			    	"response_code" => 100,
			    	"message" 	 	=> "TASK_DATA",
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
			}else{
				$response = new JsonModel(array(
					"response_code" => 202,
			    	"message" 	 => "ID_DOES_NOT_EXIST",
			    	"success" 	 => false
		        ));
			}
		}catch (Exception $e) {
		    echo 'Exception: ',  $e->getMessage(), "\n";
		}

		return $response;
	}

	public function editAction(){
		$request = $this->getRequest();
		if(!$request->isPost()){
			return new JsonModel(array(
				"response_code" => 203,
		    	"message" 	 => "NO_DATA_RECEIVED",
		    	"success" 	 => false
	        ));
		}

		$data = $request->getPost();
		if(!$data['task_id']){
			return new JsonModel(array(
				"response_code" => 201,
		    	"message" 	 => "NO_ID_RECEIVED",
		    	"success" 	 => false
	        ));
		}

		$tasks_api = $this->getServiceLocator()->get('tasks_api');

		try{
			$tasks_api->editTask($data);

		}catch (Exception $e) {
		    echo 'Exception: ',  $e->getMessage(), "\n";
		}

		return new JsonModel(array(
			"response_code" => 101,
	    	"message" 	 => "TASK_SAVED",
	    	"success" 	 => true
        ));
	}

	public function deleteAction(){
		$request = $this->getRequest();
		if(!$request->isPost()){
			return new JsonModel(array(
				"response_code" => 203,
		    	"message" 	 => "NO_DATA_RECEIVED",
		    	"success" 	 => false
	        ));
		}

		$data = $request->getPost();
		if(!$data['task_id']){
			return new JsonModel(array(
				"response_code" => 201,
		    	"message" 	 => "NO_ID_RECEIVED",
		    	"success" 	 => false
	        ));
		}

		$tasks_api = $this->getServiceLocator()->get('tasks_api');

		try{
			$tasks_api->deleteTask($data);

		}catch (Exception $e) {
		    echo 'Exception: ',  $e->getMessage(), "\n";
		}

		return new JsonModel(array(
			"response_code" => 101,
	    	"message" 	 => "TASK_DELETED",
	    	"success" 	 => true
        ));

	}

	protected function _predump($arg){
		echo "<pre>";
		var_dump($arg);
		echo "</pre>";
		die;
	}

}