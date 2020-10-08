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
    <title>2nd Libros --- Admin</title>
    <link rel="icon" href="../images/logo6.png" type="image/png" sizes="16x16">
    <link rel="stylesheet" type="text/css" href="../css/designleftright.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
</head>

<style>

body, html {
    /* height: 100%; */
    /* margin: 0; */
}

.background {
    /*Image used*/
    background: url("../images/book.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    margin: 0;
    padding: 0;
    /* Full height */
    height: 100%;
}

.welcome {
    color: white;
    font-family: "Trebuchet MS", Helvetica, sans-serif;
    font-size: 500%;
    letter-spacing: 2px;
    text-align: center;
    font-weight: 700;
    padding-top: 20%;
    margin: 0;
}

p.online {
    color: white;
    font-size: 20px;
    font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
    /*font-family: "Trebuchet MS", Helvetica, sans-serif;*/
    text-align: center;
    letter-spacing: 2px;
    padding: 100px;
}

/*.container {
    height: 200px;
    position: relative;
}*/

.center {
    /*margin: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    -ms-transform: translate(-50%,-50%);
    transform: translate(-50%, -50%);*/
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100px;
}

.indexbutton {
    background-color: #482BFF;
    border: none;
    color: white;
    padding: 14px 38px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 8px;
    transition-duration: 0.4s;
    cursor: pointer;
}

/* mouse hover */
.indexbutton:hover {
    background-color: white;
    border: #69C8FF;
    color: #482BFF;
    text-decoration: none;
}

/* selected link */
.indexbutton:active {
    background-color: #366682;
    color: white;
}

.indeximg {
  min-height: 300px;
  min-width: 400px;
  width: 50%;
  padding: 20px;
  padding-top: 120px;
  padding-bottom: 50px;
}



</style>

<body>

<div class="firstpage">
    <div class="background">

        <h1 class="welcome">Welcome to 2nd Libros</h1>
        <p class="online">--- An Online Book Store ---</p>
        
        <div class="center">
            <b><a href="booklist.php" class="indexbutton" id="shopnow" onmouseover>Go to Book List</a></b>
        </div>

        
        <p class="online" style="padding-top: 100px; margin: 0;">
            <i class="fas fa-angle-double-down" style="color: white;"></i> 
            <!--paragraph start here-->
            Learn more about Libros 
            <!--paragraph end here-->
            <i class="fas fa-angle-double-down" style="color: white;"></i>
        </p>
        
    </div>

    
</body>

<!-- JavaScript start here -->
<script type="text/javascript">

        /* for shop now */
        document.getElementById("shopnow").onmouseover = function()
        {
            changeText()
        };

        document.getElementById("shopnow").onmouseout = function()
        {
            changeBack()
        };

        function changeText()
        {
            var display = document.getElementById("shopnow");
            display.innerHTML = "";
            display.innerHTML = " Go NOW ! >>> "
        }

        function changeBack()
        {
            var display = document.getElementById("shopnow");
            display.innerHTML = "";
            display.innerHTML = "Go to Book List";
        }

</script>

<!-- JavaScript End Here -->



<?php
include("footer.php");
?>

</html>