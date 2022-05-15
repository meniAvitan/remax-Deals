<?php
include './config/app.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/table.css">
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
                    <h4>הוספת סוכנת</h4>
                    </div>
                    
                    <div class="card-body" >
                        <?php
                        include 'modells/profileModel.php';
                        $model = new ProfileModel();
                        $insert = $model->insert();
                        $agents = $model->getAgentNumber();
                        
                        
                        ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="md-3">
                                <label for="">שם סוכנת</label>
                                <input type="text" name="agentNmae" class="form-control">
                            </div>
                            <div class="md-3">
                                <label for=""> מספר סוכנת (מספר קבוע מצורפת טבלה)</label>
                                <input type="number" name="agentId" class="form-control" min="1" max="99">
                            </div>
                            <div class="md-3">
                                <label for="">תמונת פרופיל</label>
                                <input type="file" name="image" class="form-control" >
                            </div>
                            <div class="md-3">
                                <label for="">בחירת צבע</label>
                                <input type="color" name="color" class="form-control" value="#e66465">
                            </div>

                            <div class="md-3 mt-3">
                                <button type="submit" name="submit_agent" class="btn btn-primary">הוספת סוכנת</button>
                            </div>
                        </form>
                </div>
                </div>

            </div>
        </div>
<div class="agent_num_table">
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">שם סוכנת</th>
            <th scope="col">מספר  במערכת</th>
            <th scope="col">צבע  במערכת</th>
            
        </tr>
    </thead>


    <tbody>
    <?php  foreach( $agents as $agent){ ?>

    <tr>
        <td><?php echo $agent['name'] ?></td>
        <th scope="row"><?php echo $agent['agent_id'] ?></th>  
        <th class="agent_color_wrap"><div class="agentColor" style="background-color: <?php echo $agent['color']?>"></div></th>
    </tr>

    <?php }  ?>

    </tbody>
</table>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">מספר סוכנת קבוע</th>
            <th scope="col">שם סוכנת</th>
        </tr>
    </thead>


    <tbody>
        <tr>
            <th scope="row">1</th>
            <td>תמר</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>הילדה</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>חוה</td>
        </tr>
        <tr>
            <th scope="row">4</th>
            <td>תרצה</td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td>עטרי</td>
        </tr>
        <tr>
            <th scope="row">6</th>
            <td>רחל</td>
        </tr>
        <tr>
            <th scope="row">7</th>
            <td>יהודית</td>
        </tr>
        <tr>
            <th scope="row">8</th>
            <td>הדס</td>
        </tr>
        <tr>
            <th scope="row">9</th>
            <td>נורית</td>
        </tr>
        <tr>
            <th scope="row">10</th>
            <td>קמחית</td>
        </tr>
        <tr>
            <th scope="row">11</th>
            <td>רינה</td>
        </tr>
        <!-- <tr>
            <th scope="row">12</th>
            <td></td>
        </tr> -->
    </tbody>
</table>
</div>

                    
    </div>
</div>
</body>
</html>


