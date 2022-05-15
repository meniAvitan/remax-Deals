<?php

include 'config/app.php';




include 'modells/model.php';
$model = new Model();
$n = $_POST['numOfRows'];
echo $n;
for($i = 0; $i < $n; $i++){
    $insert = $model->insertGroup();
}

?>