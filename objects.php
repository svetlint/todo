<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class Carrier{
    public function takePackage(){
        
    }
    
    public abstract function delivery();
    
}


class Postman extends Carrier{
    
    public function delivery(){
        echo 'Puts mails into mailboxes';
    }
}

class Newsman extends Carrier{
    public function delivery() {
        echo 'newsman delivers newspapers';
    }
}


//////////////////////////////

class Vehicle {
    private $numberOfWheels;
    private $color;
    private $breaksType;
    private $NumberOfGears;
   
    
    
   function getNumberOfWheels() {
       return $this->numberOfWheels;
   }

   function setNumberOfWheels($numberOfWheels) {
       $this->numberOfWheels = $numberOfWheels;
   }

   function getColor() {
       return $this->color;
   }

   function setColor($color) {
       $this->color = $color;
   }

   function getBreaksType() {
       return $this->breaksType;
   }

   function getNumberOfGears() {
       return $this->NumberOfGears;
   }

   function setBreaksType($breaksType) {
       $this->breaksType = $breaksType;
   }

   function setNumberOfGears($NumberOfGears) {
       $this->NumberOfGears = $NumberOfGears;
   }



     
            
}


class Car extends Vehicle {
    private $engine;
    private $carType;
    private $numberOfDoors;
    private $brand;
    private $model;
    
    function getEngine() {
        return $this->engine;
    }

    function getCarType() {
        return $this->carType;
    }

    function getNumberOfDoors() {
        return $this->numberOfDoors;
    }

    function setEngine($engine) {
        $this->engine = $engine;
    }

    function setCarType($carType) {
        $this->carType = $carType;
    }

    function setNumberOfDoors($numberOfDoors) {
        $this->numberOfDoors = $numberOfDoors;
    }

    function getBrand() {
        return $this->brand;
    }

    function setBrand($brand) {
        $this->brand = $brand;
    }

    function getModel() {
        return $this->model;
    }

    function setModel($model) {
        $this->model = $model;
    }


    
    
}



//Interfaces 
interface Person {
    public function eat();
    public function sleep();

}

class John implements Person {
    public function eat() {
        echo "Damn shit!! <br />";
    }
    public function sleep() {
        echo "duhai!";
    }
}

