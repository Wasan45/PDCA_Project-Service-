<?php
require_once '../config/DB.php';
require_once '../model/User.php';

class UserController {

    public function UserController(){
 
    }
    
    public function login($POST){
        $db = new DB();
        $user = new User();
        $user->setEmail($POST["email"]);
        $user->setPassword($POST["password"]);

        if($user->getEmail() == ""){
            $response["status"] = 1;
            $response["msg"] = "กรุณากรอก Email";
        } else if($user->getPassword() == ""){
            $response["status"] = 2;
            $response["msg"] = "กรุณากรอก Password";
        } else {

            $array = array(
                "email" => array("type" => $user->getDataType("email"), "value" => $user->getEmail()),
                           array("type" => $user->getDataType("password"), "value" => $user->getPassword())
                     );
            $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
            $data = $db->query($sql, $array);

            if(count($data) > 0){
                $response["status"] = 0;
                $response["msg"] = "Success";
            } else {
                $response["status"] = -1;
                $response["msg"] = "ไม่พบ Email/Password นี้ในระบบ";
            }
        }
        echo json_encode($response);
    }
}
