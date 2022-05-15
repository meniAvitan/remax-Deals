<?php
include 'config/app.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>לוח עסקאות</title>
    <link rel="stylesheet" href="css/profile.css">
    <script src="https://use.fontawesome.com/f945fb7183.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
</head>
<body>
<h1 class="title">פרופיל סוכנת</h1>

<?php
include 'modells/profileModel.php';
$model = new profileModel();

$agents = $model->getAgent();

?>
    <div class="container">
    
        <div class="addDeal">
            <a href="<?php base_url('addNewAgent.php') ?>">
                <i class="fas fa-plus"></i>
            </a>
        </div>
        <div class="home">
            <a href="<?php base_url('index.php') ?>">
                <i class="fas fa-home"></i>
            </a>
        </div>
        

<?php
foreach($agents as $agent){

?>

        <div class="card_wrap">
        <div style="background-color: <?php echo $agent['color'] ?>" class="agent_color"></div>
            <div class="profileImage">
                <img src="./uploads/<?=$agent['image'] ?>" alt="<?php echo $agent['name']." profile image" ?>">
            </div>
            <div class="row agentNmae">
                <h3><?php echo $agent['name'] ?></h3>
            </div>
            <div class="action">
                <a href="<?php base_url('updateAgent.php') ?>?id=<?php echo $agent['id']; ?>">
                <i class="far fa-edit"></i>
                </a>
                <a href="<?php base_url('deleteAgent.php') ?>?id=<?php echo $agent['id']; ?>">
                <i class="far fa-trash-alt"></i>
                </a>
            </div>
        </div>

        <?php
}?>







    </div>
</body>
</html>