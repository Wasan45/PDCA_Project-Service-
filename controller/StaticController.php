<?php
require_once '../config/DB.php';

class StaticController{
    
    public function UserController(){
 
    }
    
    public function findMin($POST){
        $from_id = $POST;
        
        $db = new DB();
        $sql = "";
    }
    
    public function findMax($POST){
        $from_id = $POST;
    }
    
    public function findMean($POST){
        $from_id = $POST;
    }
    
    public function findMode($POST){
        $from_id = $POST;
    }
    
    public function findStandardDeviation($POST){
        $from_id = $POST;
    }
    
    public function findNumberAns($POST){
        $from_id = $POST;
    }
    
}

?>

