<?php

include("../include/connection.php");
include("session.php");



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/logo6.png" type="image/png" sizes="16x16">
    <title>Payment Successful</title>

    <?php include("header.php") ?>
</head>

<style>

body 
{
    letter-spacing: 2px;
}

div.imgcontainer 
{
    text-align: center;
    margin: 80px;
    margin-bottom: 20px;
    padding: 45px;
}

div.thanks
{
    text-align: center;
    padding: 0px;
    font-size: 20px;
}

a.order, a.shop 
{
    padding: 20px;
    margin: 0px;
    color: #4287f5;
    font-weight: bold;
}

h3 
{
    color: black;
    text-align: center;
}
</style>

<body>
    
    <div class="imgcontainer">
        <img src="../images/tq3.png" alt="thank you" style="width: 400px; height: 150px;">
    </div>

    <div class="thanks" align="center">
        <h3 align="center"> See your order status now! </h3>
        <a href="myorder.php" target="_blank" rel="noopener noreferrer" class="order">My Order <i class='far fa-grin-wink'></i> </a>
        <br>
        <h3> Continue shop with us! </h3>
        <a href="book.php" target="_blank" rel="noopener noreferrer" class="shop">Continue Shopping <i class='far fa-grin-hearts'></i> </a>
    </div>



</body>

<?php include("footer.php") ?>
</html>