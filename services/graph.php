<?php
header("Content-Type:application/json");
include '../controller/GraphController.php';

$graph = new GraphController();
$graph->render();
?>

