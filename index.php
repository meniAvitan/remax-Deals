<?php
include 'config/app.php';
?>
  <?php
 

  
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>לוח עסקאות</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="https://use.fontawesome.com/f945fb7183.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->


</head>
<body>
<h1 class="title">לוח עסקאות</h1>
<div class="addgroup">
    <a href="<?php base_url('addCards.php') ?>">
        הוספת מקבץ עסקאות
    </a>
</div>

<?php
include 'modells/model.php';
$model = new Model();

$deals = $model->getDeals();
$scores = $model->getCountDealsByAgent();

?>


<table id="customers">
  <tr>
    <th>סוכנת</th>
    <th>צבע</th>
    <th>סך עסקאות</th>
  </tr>


<?php

foreach($scores as $score){      
    $dataPoints = array( 
        array("y" => $score['sumDeals'], "label" => $score['name'] )
    );
?>
  <tr>
    <td><?php echo $score['name'] ?></td>
    <td style="background-color: <?php echo $score['color']?>"><?php echo $score['color'] ?></td>
    <td><?php echo $score['sumDeals'] ?></td>
  </tr>

  <?php
}
?>

</table>



    <div class="container">
        <div class="addDeal">
            <a href="<?php base_url('addNewDeal.php') ?>">
                <i class="fas fa-plus"></i>
            </a>
        </div>
        <div class="profile">
            <a href="<?php base_url('profile.php') ?>">
                <i class="far fa-user"></i>
            </a>
        </div>




<?php
$card_index_num = 1;
foreach($deals as $deal){
 

?>

   

    <div class="card_wrap">

    <div style="background-color: <?php echo $deal['color'] ?>" class="agent_color "></div>
    <div class="cardNumber">
        <h5><?php  echo $card_index_num; ?></h5>
    </div>
    <div class="profileImage">
        <a href="./profile.php" >
            <img src="./uploads/<?=$deal['image'] ?>" alt="<?php echo $deal['name']." profile image" ?>" alt="">

        </a>
    </div>
    <h3><?php echo $deal['name'] ?></h3>
    <div class="row dealType">
        <h1><?php echo $deal['type'] ?></h1>
    </div>
    <div class="row dealAddress">
        <h2><?php echo $deal['address'] ?> </h2>
    </div>
    <div class="row price" >
        <h2><?php if($deal['price'] == 0)
        {
        echo "<h2 dir='rtl'>מקום זה שמור ל...</h2>";
        }
        else
        {
        ?></h2>
            <h2>₪ <?php   echo $deal['price'];
        } ?> 
        </h2>
    </div>
    <div class="action">
        <a href="<?php base_url('updateDeal.php') ?>?id=<?php echo $deal['deal_id']; ?>">
        <i class="far fa-edit"></i>
        </a>
        <a href="<?php base_url('deleteDeal.php') ?>?id=<?php echo $deal['deal_id']; ?>">
        <i class="far fa-trash-alt"></i>
        </a>
    </div>
  </div>
<!-- </div> -->

<?php
$card_index_num ++;
}
?>

</div>




<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>
</html>