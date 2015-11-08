<?php
header("Content-Type:application/json");
include '../controller/UserController.php';

    $user = new UserController();
    $user->login($_POST);

?>
