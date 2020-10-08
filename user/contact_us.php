<?php

include("../include/connection.php");
include("session.php");
include("header.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="../images/logo6.png" type="image/gif" sizes="16x16">
    <title>Contact Us</title>
</head>

<style>

div.container p 
{
    font-size: 20px;
}

div.container
{
    color: black;
    padding: 30px;
    letter-spacing: 2px;
}

h1 
{
    padding: 20px 0;
}

</style>

<body>
<div class="container">
    <h1>Contact Us</h1>

    <p>Hello there! We are recently using social media. Please follow us to stay tune fo more new information and new arrivals! Ah, also promotions! <i class='far fa-grin-squint'></i></p>

    <p>If you have any question and feedback, please contact us! We are looking forward for your feedback to make us improve <i class='fas fa-heart'></i></p>

    <!-- Email -->
    <div>
        <br>
        <p>
            <img src="../images/email.png" alt="Email Us!" style="width: 50px; height: 50px;">
            Email: &emsp;&emsp;&nbsp;
            <a href="mailto:secondlibros@gmail.com&amp; Subject=Feedback&amp; Body=?>"> secondlibros@gmail.com</a>
        </p>
        <br>
    </div>

    <!-- Facebook -->
    <div>
        <br>
        <p>
            <img src="../images/facebook.png" alt="Second Libros" style="width: 50px; height: 50px;">
            Facebook: &nbsp;
            <a href="http://www.facebook.com/secondlibros" target="_blank">Second Libros</a>
        </p>
        <br>
    </div>

    <div>
        <!-- Whatsapp -->
        <br>
        <p>
            <img src="../images/whatsapp.png" alt="Whatsapp Now!" style="width: 50px; height: 50px;">
            Whatsapp: &nbsp;
            <a href="tel:+60199654833">+60199654833</a>
        </p>
        <br>
    </div>

    
    <div>
    <!-- Instagram -->
        <br>
        <p>
            <img src="../images/instagram.png" alt="Libros Online Bookstore" style="width: 50px; height: 50px;">
            Instagram: &nbsp;
            <a href="http://instagram.com/2ndlibros" >2nd Libros</a>
        </p>
        <br>
    </div>

</div>
</body>

<?php include("footer.php"); ?>


</html>