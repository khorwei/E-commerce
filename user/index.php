<?php

    include("../include/connection.php");
    include("session.php");

    // echo ($_SESSION['login_user']);
    // if((!isset($_SESSION['login_user']) && !empty($_SESSION['login_user'])))
    // {
    //     include("session.php");
    //     include("header.php");
    // }
    // else
    // {
    //     include("header.php");
    // }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2nd Libros</title>
    <link rel="stylesheet" type="text/css" href="../css/designleftright.css">
    <link rel="icon" href="../images/logo6.png" type="image/gif" sizes="16x16">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
</head>

<?php 
    include("header.php");
    ?>

<style>

h1 
{
    color: #2d3787;
    text-transform: uppercase;
}

.background{
    /*Image used*/
    background: url("../images/book.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
    background-color: rgba(255, 0, 0, 0.5);
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
    opacity: 1.0;
    z-index: 1;
}

p.online {
    color: white;
    font-size: 20px;
    font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
    text-align: center;
    letter-spacing: 2px;
}

.center {
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

.mySlides
{
    display: none;
}

/* Slideshow container */
.slideshow-container
{
    max-width: 100%;
    position: relative;
    margin: auto;
}

/* Number text (1/3 etc) */
.numbertext 
{
  color: black;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot 
{
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active 
{
  background-color: #717171;
}

/* Fading animation */
.fade 
{
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade 
{
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade 
{
  from {opacity: .4} 
  to {opacity: 1}
}

a.email:hover 
{
    background-color: white;
    padding: 0;
    color: red;
    text-decoration: underline;
}

.faq 
{
    text-align: center;
    left: 0;
}
</style>

<body>

    <div class="background ">

        <h1 class="welcome">Welcome to 2nd Libros</h1>
        <p class="online">--- An Online Book Store ---</p>
        
        <div class="center">
            <b><a href="book.php" class="indexbutton" id="shopnow" onmouseover>Shop Now</a></b>
        </div>

        
        <p class="online" style="padding-top: 100px; margin: 0;">
            <i class="fas fa-angle-double-down" style="color: white;"></i> 
            <!--paragraph start here-->
            Learn more about Libros 
            <!--paragraph end here-->
            <i class="fas fa-angle-double-down" style="color: white;"></i>
        </p>
        <br><br><br>
        
    </div>

    <!--  Content -->
    <div class="content">

<!-- leftcontent contentpadding rightcontent lead to footer -->

        <!-- First Grid -->
        <div class="rightcontent contentpadding clear">

            <img src="../images/logo7.png" alt="About Us" align="right" class="indeximg">
            <h1>About Us</h1>

            <div class="detail">

                <p>
                Do you think the new book is too expensive? Do you like reading but do not have the money to buy new books? Congratulations, you are in the right place! <b style="color:#366682;"><em>Libros</em></b> will be your paradise! Here, you can find the long-awaited love book, and you can buy it at a reasonable price. Fear of buying tattered books? We absolutely guarantee that the books we sell are intact. If there are small defects, the price will be relatively low. 
                </p>

                <!-- <div class="indexbutton">
                <a href="aboutus.php" target="_self" rel="noopener noreferrer" class="readmore" id="readmore"> Read More</a>
                </div> -->

            </div>
        </div>
        <!-- First Grid End -->

        <!-- Second Grid -->
        <div class="leftcontent contentpadding clear">
            
            <img src="../images/book.gif" alt="Where the book form?" align= "left" class="indeximg">
            <h1>What we sell?</h1>
            
            <div class="detail">
                
                <ul>
                    <li>Chinese Book</li>
                    <li>English Book</li>
                    <li>Other Book (include children book)</li>
                </ul>

                <br><br>
                <p>We will add on more kind of book in the future! The categries we plan to add are Magazines, References Book, Textbook and so on! Please follow us for the latest news! If you have any book would like to sell, please feel free to contact us through <a href="mailto:secondlibros@gmail.com" class="email">email</a>!</p>

            </div>
        </div>
        <!-- Second Grid End Here -->

        <!-- Third Grid -->
        <div class="rightcontent contentpadding clear thirdgrid">


            <div class="slideshow-container">

                <div class="mySlides fade">
                    <img src="../images/visa.png" alt="Visa" align="right" class="indeximg" style="height: 500px; width:400px;">
                </div>

                <div class="mySlides fade">
                    <img src="../images/mastercard.png" alt="Master Card" align="right" class="indeximg" style="height: 500px; width:400px;">
                </div>


            </div>

            <h1>Payment Method</h1>

            <div class="detail">
            <br>

                <p style="color: #366682;">
                We only provide online payment: &emsp;&emsp;&emsp;
                <ul>
                    <li>Credit Card</li>
                    <li>Debit Card</li>
                </ul>
                <br>
                Sorry for the incovience, we will provide more option for payment in the future! Please feel free to suggest us and give us feedback.
                </p>

            </div>
        </div>
        <!-- Third Grid End Here -->

        <!-- Fourth Grid -->
        <div class="leftcontent contentpadding clear">
            
            <img src="../images/truck.gif" alt="Where the book form?" align= "left" class="indeximg">
            <h1 id="delivery">Delivery Services</h1>
            
            <div class="detail">

                <br><br>
                <p>If make payment after 3pm, the books will ship on the next days. Basically, it will take 3 to 5 days to deliver. It depends on the courier. We are using DHL as our main delivery services. If you would likt to change the delivery services, please contact us! We will try our best to suit with you!</p>

            </div>
        </div>
        <!-- Fourth Grid End Here -->

        <div>
            <div class="faq">
                <img src="../images/faq.gif" alt="FAQ" width="75%;" class="faq">
            </div>
            
            <h1>Frequent Asked Questions</h1>

            <br>
            <h4><strong>Q1. How long it will take to deliver?</strong></h4>
            <p>It usually takes 3 to 5 days. After receiving the order, we need to pack the book with bubble wrap and make sure it wraps properly.</p>

            <br>
            <h4><strong>Q2. Can I return my order?</strong></h4>
            <p>Yes, you can return it. We only accept returns within 7 days after receiving the book. If you would like to return your book with valid reasons (eg. wrong book, broken and other valid reason), please contact us as soon as possible.</p>

            <br>
            <h4><strong>Q3. How to delete my account?</strong></h4>
            <p>If you hope to permanently remove your account, please contact us through email!</p>

            <br>
            <h4><strong>Q4. How to change my profile?</strong></h4>
            <p>You can edit your profile through "My Profile" or <a href="myprofile.php">CLICK HERE!</a></p>
            
            <br>
            <h4><strong>Q5. I want to sell my book. How can I sell?</strong></h4>
            <p>Thanks for trusting us! Please contact us through <a href="mailto: secondlibros@gmail.com" class="email">email</a>  or any social media. <a href="conatct_us.php" target="_blank">CONTACT US NOW!</a></p>

            <br>
            <h4><strong>Q6. </strong></h4>
            <p>Thanks for trusting us! Please contact us through <a href="mailto: secondlibros@gmail.com" class="email">email</a>  or any social media. <a href="conatct_us.php" target="_blank">CONTACT US NOW!</a></p>
            
        </div>

    </div>
    <!-- Contetn End Here -->

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
            display.innerHTML = "Shop Now >>>"
        }

        function changeBack()
        {
            var display = document.getElementById("shopnow");
            display.innerHTML = "";
            display.innerHTML = "Shop Now";
        }


var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    // var dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}    
    // for (i = 0; i < dots.length; i++) {
    //     dots[i].className = dots[i].className.replace(" active", "");
    // }
    slides[slideIndex-1].style.display = "block";  
    // dots[slideIndex-1].className += " active";
    setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script>

    </script>

    <!-- JavaScript End Here -->
</body>


<!-- footer start here -->
<?php include("footer.php"); ?>
</html>