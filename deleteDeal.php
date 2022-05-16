<?php

include 'config/app.php';
include './modells/model.php';
$model = new Model();
$id = $_REQUEST['id'];
$delete = $model->deleteAgent($id);


?>