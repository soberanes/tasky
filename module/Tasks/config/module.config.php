<?php
return array(
	'view_manager' => array(  
        'template_path_stack' => array(
            'tasks' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'tasks' => 'Tasks\Controller\TasksController',
        ),
    ),
    'router' => array(
	    'routes' => array(
	        'tasks' => array(
	            'type'    => 'Segment',
	            'options' => array(
	                'route'    => '/tasks[/:action[/:id]]',
	                'defaults' => array(
	                    'controller'    => 'tasks',
	                    'action'        => 'index',
	                ),
	                'constraints' => array(
	                    'action' => '(get|add|edit|delete)',
	                    'id'     => '[0-9]+',
	                ),
	            ),
	        ),
	    ),
    ),
);