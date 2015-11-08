<?php

class User {
    private $email;
    private $password;
    private $firstname;
    private $lastname;
    private $dataType = array(
                                "email" => "s",
                                "password" => "s",
                                "firstname" => "s",
                                "lastname" => "s"
                             );
    
    public function getDataType($field){
        return $this->dataType[$field];
    }
    
    public function setEmail($email){
        $this->email = trim($email);
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    public function setPassword($password){
        $this->password = trim($password);
    }
    
    public function getPassword(){
        return $this->password;
    }
    
    public function setFirstname($firstname){
        $this->firstname = $firstname;
    }
    
    public function getFirstname(){
        return $this->firstname;
    }
    
    public function setLastname($lastname){
        $this->lastname = $lastname;
    }
    
    public function getLastname(){
        return $this->lastname;
    }
}
