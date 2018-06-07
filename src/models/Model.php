<?php
namespace src\models;

use etc\db\Database;
/**
 * Description of Model
 *
 * @author Sabri Hamda
 */
abstract class Model {

    private $errors = [];
    
    private $db;
    
    public function getDb(){
        if($this->db === null){
        $this->db = Database::getInstance();
        }
        return $this->db;
    }
    public function addError($attribute, $error) {
        $this->errors[$attribute] = $error;
    }

    public function getErrors() {
        return $this->errors;
    }

}
