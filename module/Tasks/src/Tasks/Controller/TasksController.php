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
		date_default_timezone_set('America/Mexico_City');

		$request = $this->getRequest();
		$id = (int) $this->params()->fromRoute('id', 0);

		if(!$id){
			return new JsonModel(array(
				"response_code" => 201,
		    	"message" 	 => "NO_ID_RECEIVED",
		    	"success" 	 => false
	        ));
		}

		$tasks_api = $this->getServiceLocator()->get('tasks_api');

		try{
			$task = $tasks_api->getTaskById($id);
			if($task){
				$status_txt = ($task->getStatus() == 1) ? "completada" : "pendiente";
				
				$response = new JsonModel(array(
			    	"response_code" => 100,
			    	"message" 	 	=> "TASK_DATA",
			    	"task" 			=> array(
			    		"task_id" 		=> $task->getTaskId(),
		                "title" 		=> $task->getTitle(),
		                "description" 	=> $task->getDescription(),
		                "creation_date" => date("d/m/Y g:i a", $task->getCreationDate()),
		                "last_update" 	=> date("d/m/Y g:i a",$task->getLastUpdate()),
		                "complete_date" => $task->getCompletedDate(),
		                "tag" 			=> $task->getTag(),
		                "status" 		=> $status_txt
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