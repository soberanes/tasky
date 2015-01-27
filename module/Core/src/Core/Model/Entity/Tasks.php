<?php

namespace Core\Model\Entity;

class Tasks implements TasksInterface {

	/**
     * @var Int
     */
    protected $task_id;

    /**
     * @var String
     */
    protected $title;

    /**
     * @var String
     */
    protected $description;

    /**
     * @var Int
     */
    protected $creation_date;

    /**
     * @var Int
     */
    protected $last_update;

    /**
     * @var Int
     */
    protected $complete_date;

    /**
     * @var String
     */
    protected $tag;

    /**
     * @var Int
     */
    protected $status;

    public function __construct(){
        $this->creation_date = strtotime(date('Y-m-d H:i:s'));
    }

    /**
     * Get task_id
     *
     * @return Int
     */
    public function getTaskId() {
        return $this->task_id;
    }

    /**
     * Set task_id
     *
     * @param Int $task_id
     * @return TasksInterface
     */
    public function setTaskId($task_id) {
        $this->task_id = (int) $task_id;
        return $this;
    }

    /**
     * Get title
     *
     * @return String
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param String $title
     * @return TasksInterface
     */
    public function setTitle($title) {
        $this->title = (string) $title;
        return $this;
    }

    /**
     * Get description
     *
     * @return String
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param Int $description
     * @return TasksInterface
     */
    public function setDescription($description) {
        $this->description = (string) $description;
        return $this;
    }
    
    /**
     * Get creation_date
     *
     * @return Int
     */
    public function getCreationDate(){
    	return $this->creation_date;
    }

    /**
     * Set creation_date
     *
     * @param Int $creation_date
     * @return TasksInterface
     */
    public function setCreationDate($creation_date){
    	$this->creation_date = (int) $creation_date;
    	return $this;
    }
  
    /**
     * Get last_update
     *
     * @return Int
     */
    public function getLastUpdate(){
        return $this->last_update;
    }

    /**
     * Set last_update
     *
     * @param Int $last_update
     * @return TasksInterface
     */
    public function setLastUpdate($last_update){
        $this->last_update = (int) $last_update;
        return $this;
    }

    /**
     * Get complete_date
     *
     * @return Int
     */
    public function getCompletedDate(){
    	return $this->complete_date;
    }

    /**
     * Set complete_date
     *
     * @param Int $complete_date
     * @return TasksInterface
     */
    public function setCompletedDate($complete_date){
    	$this->complete_date = (int) $complete_date;
    	return $this;
    }

	/**
     * Get tag
     *
     * @return String
     */
    public function getTag(){
    	return $this->tag;
    }

    /**
     * Set tag
     *
     * @param String $tag
     * @return TasksInterface
     */
    public function setTag($tag){
    	$this->tag = (string) $tag;
    	return $this;
    }

	/**
     * Get status
     *
     * @return Int
     */
	public function getStatus(){
		return $this->status;
	}

	/**
     * Set status
     *
     * @param Int $status
     * @return TasksInterface
     */
	public function setStatus($status){
		$this->status = (int) $status;
		return $this;
	}
	
}