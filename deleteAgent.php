<?php

include 'config/app.php';
include 'modells/profileModel.php';
$model = new profileModel();
$id = $_REQUEST['id'];
$delete = $model->deleteAgent($id);


?>