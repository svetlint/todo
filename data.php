<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$menu = array(
    0 => array(
        'name'  => 'Home',
        'link'  => 'index.php?page=home',
    ),
    1 => array(
        'name' => 'Tasks',
        'link' => 'index.php?page=tasks',
    ),
    2 => array(
        'name' => 'Finished',
        'link' => 'index.php?page=finished',
    ),
    3 => array(
        'name' => 'Statistics',
        'link' => 'index.php?page=stats',
    ),
);

$dateFormat = 'Y-M-d  H:i';

$tasks = array(
    array(
        'id' => 1,
        'name' => 'Task 1',
        'description' => 'Description for Task 1',
        'priority' => 'High',
        'created' => '2015-01-19 19:26',
        'dueDate' => '2015-01-19 20:00',
    ),
    array(
        'id' => 2,
        'name' => 'Task 2',
        'description' => 'Description for Task 2',
        'priority' => 'Low',
        'created' => '2015-01-19 19:26',
        'dueDate' => '2015-01-21 09:00',
    ),
    array(
        'id' => 3,
        'name' => 'Task 3',
        'description' => 'Description for Task 3',
        'priority' => 'High',
        'created' => '2015-01-19 19:26',
        'dueDate' => '2015-01-14 20:00',
       // 'dueDate' => date($dateFormat, time() + mktime(22, 0, 0, 1, 20, 2015)),
       //'dueDate' => date($dateFormat,  strtotime("-3 day")),
    ),
);

