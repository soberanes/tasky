<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core\Model;

use ZfcBase\Mapper\AbstractDbMapper;
use Zend\Stdlib\Hydrator\ArraySerializable;
use Zend\Db\Sql\Expression as Expresion;
use Core\Model\Entity\Tasks as TaskEntity;

class TasksMapper extends AbstractDbMapper{

	protected $tableName = 'tasks';

    public function fetchAll($limit = null){
        $select = $this->getSelect();
        $entity = $this->select($select);
        
        return $entity;
    }

	public function addTask($entity, $tableName = null, HydratorInterface $hydrator = null) {

        $entityExists1 = $this->findByTaskId($entity->getTaskId());
        $entityExists2 = $this->exists($entity->getTitle(), $entity->getDescription());
        if (!$entityExists1 && !$entityExists2) {
            $result = parent::insert($entity, $tableName, $hydrator);
            $entity->setTaskId($result->getGeneratedValue());
            return $entity;
        }
        return null;
    }

    public function findByTaskId($task_id) {
        $select = $this->getSelect();
        $select->where->like('task_id', $task_id);
        return $this->select($select)->current();
    }

    public function exists($title, $description) {
        $select = $this->getSelect();
        $select->where->like('title', $title);
        $select->where->like('description', $description);
        return $this->select($select)->current();
    }

    public function findBy($key, $value) {
        $select = $this->getSelect();
        $select->where->like($key, $value);
        return $this->select($select)->current();
    }

    public function updateTask($entity, $tableName = null, HydratorInterface $hydrator = null) {
        $where = array('task_id' => $entity->getTaskId());
        $result = parent::update($entity, $where, $tableName, $hydrator);
        return $result;
    }

    public function deleteTask($entity, $tableName = null){
        $where = array('task_id' => $entity->getTaskId());
        return $result = parent::delete($where, $tableName);
    }

}