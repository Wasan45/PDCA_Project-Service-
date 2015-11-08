<?php
header("Content-Type:application/json");
include '../controller/FormController.php';

    $form = new FormController();
    if($_POST['action'] == "save")
        $form->save($_POST['forms']);
    else if($_POST['action'] == "getRef")
        $form->getRef($_POST);
    else if($_POST['action'] == "getForm")
        $form->getForm($_POST);
    else if($_POST['action'] == "getTopic")
        $form->getTopic($_POST);
?>
