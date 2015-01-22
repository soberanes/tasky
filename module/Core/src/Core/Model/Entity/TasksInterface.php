<?php

namespace Core\Model\Entity;

interface ClientesInterface {

	/**
     * Get task_id
     *
     * @return Int
     */
    public function getTaskId();

     /**
     * Set task_id
     *
     * @param Int $task_id
     * @return TasksInterface
     */
    public function setTaskId($task_id);

    /**
     * Get title
     *
     * @return String
     */
    public function getTitle();

     /**
     * Set title
     *
     * @param String $title
     * @return TasksInterface
     */
    public function setTitle($title);
    
    /**
     * Get description
     *
     * @return String
     */
    public function getDescription();

     /**
     * Set description
     *
     * @param String $description
     * @return TasksInterface
     */
    public function setDescription($description);

    /**
     * Get creation_date
     *
     * @return Int
     */
    public function getCreationDate();

     /**
     * Set creation_date
     *
     * @param Int $creation_date
     * @return TasksInterface
     */
    public function setCreationDate($creation_date);

    /**
     * Get last_update
     *
     * @return Int
     */
    public function getLastUpdate();

     /**
     * Set last_update
     *
     * @param Int $last_update
     * @return TasksInterface
     */
    public function setLastUpdate($last_update);

    /**
     * Get tag
     *
     * @return String
     */
    public function getTag();

     /**
     * Set tag
     *
     * @param Int $tag
     * @return TasksInterface
     */
    public function setTag($tag);

    /**
     * Get status
     *
     * @return Int
     */
    public function getStatus();

     /**
     * Set status
     *
     * @param Int $status
     * @return TasksInterface
     */
    public function setStatus($status);

}