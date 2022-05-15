<?php
include 'config/app.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css/main.css"> -->
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                

                <div class="card" style="margin-bottom: 3rem;">
                    <div class="card-header">
                    <h4>עדכון עסקה</h4>
                    </div>
                    
                    <div class="card-body" >
                        <?php
                            include 'modells/model.php';
                            $model = new Model();
                            $id = $_GET['id'];
                            $deal = $model->editDeal($id);

                            if (isset($_POST['update_deal'])) {
                                if (isset($_POST['agentNmae']) ) {
                                if (!empty($_POST['agentNmae'])  ) {
                                    
                                    $data['id'] = $id;
                                    $data['agent_id'] = $_POST['agentNmae'];
                                    $data['address'] = htmlspecialchars($_POST['address']);
                                    $data['typeDeal'] = htmlspecialchars($_POST['typeDeal']);
                                    $data['price'] = htmlspecialchars($_POST['price']);
                            
                                    $update = $model->updateDeal($data);
        
        
                            
                                    if($update){
                                            var_dump($update);
        
                                        // echo "<script>alert('You updated a deal successfuly!');</script>";
                                        // echo "<script> window.location.href = 'index.php' </script>";
                                    }else{
                                        var_dump($update);
                                        // echo "<script>alert('Add deal failed!');</script>";
                                        // header("Location: updateDeal.php?id=$id");
                                    }
                            
                                }else{
                                    var_dump($update);
                                    // echo "<script>alert('empty');</script>";
                                    // header("Location: updateDeal.php?id=$id");
                                }
                                }
                            }
                            
                        ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="md-3">
                                <label for="">שם סוכנת</label>
                                <div class="old_name form-control mb-2"><?php echo $deal['name'] ?></div>
                                <select class="form-select form-control" name="agentName" aria-label="Default select example">
                                    <option selected>שם הסוכנת מרשימת בחירה</option>
                                    <option value="1">תמר</option>
                                    <option value="2">הילדה</option>
                                    <option value="3">חוה</option>
                                    <option value="4">תרצה</option>
                                    <option value="5">עטרי</option>
                                    <option value="6">רחל</option>
                                    <option value="7">יהודית</option>
                                    <option value="8">הדס</option>
                                    <option value="9">נורית</option>
                                    <option value="10">קמחית</option>
                                    <option value="11">רינה</option>
                                    
                                </select>
                            </div>
                            <div class="md-3">
                                <label for="">כתובת הנכס</label>
                               <input class="form-control" name="address" type="text" value="<?php echo $deal['address'] ?>">
                            </div>
                            <div class="md-3">
                                <label for="">סוג העסקה</label>
                                <div class="old_name form-control mb-2"><?php echo $deal['type'] ?></div>
                                <select class="form-select form-control" name="typeDeal" aria-label="Default select example">
                                    <option selected>סוג העסקה מרשימת בחירה</option>
                                    <option value="מכירה">מכירה</option>
                                    <option value="קניה">קניה</option>
                                    <option value="השכרה">השכרה</option>
                                </select>
                            </div>
                            <div class="md-3">
                                <label for="">סכום העסקה</label>
                               <input class="form-control" name="price" type="text" name="" id="" value="<?php echo $deal['price'] ?>">
                            </div>

                            <div class="md-3 mt-3">
                                <button type="submit" name="update_deal" class="btn btn-primary">עדכון עסקה</button>
                            </div>
                        </form>
                </div>
                </div>

            </div>
        </div>
        
    </div>
</div>
</body>
</html>


