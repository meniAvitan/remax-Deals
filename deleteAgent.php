<?php

include 'config/app.php';
include 'profileModel.php';
$model = new profileModel();
$id = $_REQUEST['id'];
$delete = $model->deleteAgent($id);

// if($delete){
//     // echo "<script>alert('delete successfully');</script>";
//     // echo "<script>window.location.href = 'profile.php';</script>";
// }

?>