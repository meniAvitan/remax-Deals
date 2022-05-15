<?php



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<div class="home">
    <a href="./index.php">
        דף הבית
    </a>
</div>
<h3>מספר עסקאות</h3>
<div class="card">
    <form method="POST" action="validateAddCards.php">
        <div class="md-3 m-3">
        <input class="form-control " type="number" id="myNumber" name="numOfRows" placeholder="הכנס מספר עסקאות...">
        </div>
        <div class="md-3 m-3">
        <input class="form-control" type="number" id="myNumber" name="cardsGroup" placeholder="מספר חודש...">
        </div>
        
        <input class="btn btn-primary m-3" type="submit" value="Submit" name="submit" >
    </form>
</div>

    

</body>
</html>

