<?php
include './config/app.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css/profile.css"> -->
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="py-5">
<a href="./profile.php">פרופיל אישי</a>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                

                <div class="card" style="margin-bottom: 3rem;">
                    <div class="card-header">
                    <h4>עדכון סוכנת</h4>
                    </div>
                    
                    <div class="card-body" >
                        <?php
                        include 'profileModel.php';
                        $model = new ProfileModel();
                        $id = $_GET['id'];
                        $edit = $model->editAgent($id);
                        if (isset($_POST['update_agent'])) {
                            if (isset($_POST['agentNmae']) ) {
                            if (!empty($_POST['agentNmae'])  ) {
                                
                                $data['id'] = $id;
                                $data['name'] = $_POST['agentNmae'];
                                $data['image'] = $_FILES['image']['name'];
                                $data['color'] = $_POST['color'];
                        
                                $update = $model->update($data);
    
    
                        
                                if($update){
    
    
                                    echo "<script>alert('You updated a book successfuly!');</script>";
                                    echo "<script> window.location.href = 'profile.php' </script>";
                                }else{
                                    echo "<script>alert('Add book failed!');</script>";
                                    echo "<script> window.location.href = 'index.php' </script>";
                                }
                        
                            }else{
                                echo "<script>alert('empty');</script>";
                                header("Location: updateAgent.php?id=$id");
                            }
                            }
                        }

                        
                        ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <div class="md-3">
                                <label for="">שם סוכנת</label>
                                <input type="text" name="agentNmae" class="form-control" value="<?php echo $edit['name']  ?>">
                            </div>
                            <div class="md-3">
                                <label for="">תמונת פרופיל</label>
                                <input type="file" name="image" class="form-control" >
                            </div>

                            <div class="md-3 mt-3">
                                <input type="hidden" name="old_image" value="<?php echo $edit['image'] ?>">
                                <img style="width: 100px; height: 100px; border-radius: 50%" class="old_image" src="./uploads/<?php echo $edit['image'] ?>" alt="old image">
                            </div>

                            <div class="md-3">
                                <label for="">עדכון צבע</label>
                                <input type="color" name="color" class="form-control" value="<?php echo $edit['color'] ?>">
                            </div>

                            <div class="md-3 mt-3">
                                <button type="submit" name="update_agent" class="btn btn-primary">עדכון סוכנת</button>
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


