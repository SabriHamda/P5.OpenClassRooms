<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace src\models;

/**
 * Description of Model
 *
 * @author Sabri Hamda
 */
abstract class Model {

    private $errors = [];

    public function addError($attribute, $error) {
        $this->errors[$attribute] = $error;
    }

    public function getErrors() {
        return $this->errors;
    }
    
    public function getDb(){
        
    }

}
