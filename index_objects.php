<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require './objects.php';

$mercedesC200 = new Car();
$mercedesC200->setBrand('Mercedes');
$mercedesC200->setBreaksType('Disks');
$mercedesC200->setCarType('Sedan');
$mercedesC200->setColor('Silver');
$mercedesC200->setModel('C200');


$dacia = new Car();
$dacia->setBrand('Dacia');
$dacia->setModel('Sandero');

echo 'Car1 : <br />';
echo 'Brand: ' . $mercedesC200->getBrand() . '<br />';
echo 'Model: ' . $mercedesC200->getModel() . '<br />';


