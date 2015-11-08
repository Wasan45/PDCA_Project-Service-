<?php
require_once '../config/DB.php';
//require_once '../model/User.php';

class FormController {

    public function UserController(){
 
    }
    
//    Array
//(
//    [header] => tttt
//    [topic] => tt
//    [data] => Array
//        (
//            [0] => Array
//                (
//                    [0] => tt
//                )
//
//        )
//
//)
    
    public function save($POST){
        $db = new DB();
   
        $ref = "TF". date("dmyhis");
        
//        for($i = 0; $i < count($POST); $i++){
//            if(count($POST[$i]) > 1)
//                $type = "radio";
//            else
//                $type = "text";
//            $sql = "INSERT INTO forms (question, ref, user_id, type) VALUES ('". $POST[$i][0] ."','". $ref ."', '1','". $type ."')";
//            $last_id = $db->insert($sql);
//            for($j = 0; $j < count($POST[$i]); $j++){
//                $sql = "INSERT INTO choices (form_id, choice) VALUES ('". $last_id . "', '". $POST[$i][$j] . "')";
//                $db->insert($sql);
//            }
//        }
        
        $sql = "INSERT INTO topics (topic, create_dt) VALUES ('". $POST["topic"] ."', now())";
        $last_topic_id = $db->insert($sql);
        
        for($i = 0; $i < count($POST["data"]); $i++){
            $last_from_id = 0;
            if(count($POST["data"][$i]) > 1){
                $sql = "INSERT INTO froms (question) VALUES ('". $POST["data"][$i][0] ."')";
                $last_from_id = $db->insert($sql);
            }
        
            $start = ($last_from_id == 0)?0:1;
            for($j = $start; $j < count($POST["data"][$i]); $j++){
                $sql = "INSERT INTO questions (question, from_id, topic_id) VALUES ('". $POST["data"][$i][$j] ."', '".$last_from_id."', '".$last_topic_id."')";
                $db->insert($sql);
            }

        }
        
            
        
                $response["status"] = 0;
                $response["msg"] = "Success";
        
        echo json_encode($response);
    }
    
    public function getRef($POST){
       $db = new DB();
       
            $array = array(
                "user_id" => array("type" => "d", "value" => "1"));
            $sql = "SELECT ref FROM forms WHERE user_id = 1 GROUP BY ref";
            $data = $db->querySQL($sql);

            if(count($data) > 0){
                $response["status"] = 0;
                $response["msg"] = "Success";
                $response["data"] = $data;
            } else {
                $response["status"] = -1;
                $response["msg"] = "ไม่พบข้อมูลในระบบ";
            }
        
        echo json_encode($response);
    }
    
    public function getTopic($POST){
       $db = new DB();
       
            $array = array(
                "user_id" => array("type" => "d", "value" => "1"));
            $sql = "SELECT topic FROM topics";
            $data = $db->querySQL($sql);

            if(count($data) > 0){
                $response["status"] = 0;
                $response["msg"] = "Success";
                $response["data"] = $data;
            } else {
                $response["status"] = -1;
                $response["msg"] = "ไม่พบข้อมูลในระบบ";
            }
        
        echo json_encode($response);
    }
    
    public function getForm($POST){
        $db = new DB();
        
        $array = array(
                "ref" => array("type" => "s", "value" => $POST['ref']));
        $sql = "SELECT choices.* FROM  forms
                LEFT JOIN choices ON forms.id = choices.form_id
                WHERE ref = '" . $POST['ref'] . "'";
        
        $choice = $db->querySQL($sql);

        $sql = "SELECT * FROM forms WHERE ref = '" . $POST['ref'] . "'";
        $question = $db->querySQL($sql);

            if(count($question) > 0){
                $response["status"] = 0;
                $response["msg"] = "Success";
                $response["question"] = $question;
                $response["choice"] = $choice;
            } else {
                $response["status"] = -1;
                $response["msg"] = "ไม่พบข้อมูลในระบบ";
            }
            echo json_encode($response);
    }
}
