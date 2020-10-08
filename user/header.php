<?php
//include("footer.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src = "https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
/* body 
{
  line-height: normal;
} */

.dropbtn, .book_dropbtn 
{
  font-family: "Trebuchet MS", Helvetica, sans-serif;
  background-color: #366682;
  color: white;
  font-size: 18px;
  border: none;
  cursor: pointer;
  margin: 0;
  letter-spacing: 2px;
  padding: 12px 16px;
}

.navmenu a, .navmenu 
{
  font-family: "Trebuchet MS", Helvetica, sans-serif;
  background-color: #366682;
  color: white;
  padding: 0px 16px;
  font-size: 18px;
  border: none;
  margin: 0;
  letter-spacing: 2px;
  height: auto;
}

div a:hover
{
  background-color: #a7b6c9;
  text-decoration: none;
  color: black;
  cursor: pointer;
  font-weight: none;
  padding: 12px 16px;
  font-style: italic;
  cursor: pointer;
}

.dropbtn:hover, 
.dropbtn:focus, 
.book_dropbtn:hover, 
.book_dropbtn:focus 
{
  background-color: #a7b6c9;
  text-decoration: none;
  color: black;
  font-style: italic;
  font-weight: none;
  padding: 10px 16px;
}

.dropdown 
{
  position: relative;
  display: inline-block;
}

.dropdown-content, 
.dropdown-book 
{
    font-family: "Trebuchet MS", Helvetica, sans-serif;
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    width: 210px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a, 
.dropdown-book a 
{
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    color: white;
}

.dropdown a:hover 
{
  background-color: #95C9C9;
  color: black;
}

.show 
{
  display: block;
}

.topcontainer 
{
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}

@media (min-width: 768px)
{
  .container 
  {
    width: 750px;
  }
}

@media (min-width: 992px)
{
  .container 
  {
    width: 970px;
  }
}

@media (min-width: 1200px)
{
  .container 
  {
    width: 1170px;
  }
}

.top-text-center 
{
  text-align: center;
}

.jumbotron 
{
  margin-bottom: 0;
  background-color: #b8d0de;
  padding: 10px;
}

.grad1 
{
  background-image: linear-gradient(#71a2bd, #366682);
}

/* Sticky Social Bar */
.icon-bar {
  position: fixed;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
}

.icon-bar a {
  display: block;
  text-align: center;
  padding: 16px;
  transition: all 0.3s ease;
  color: white;
  font-size: 20px;
}

.icon-bar a:hover {
  opacity: 0.8;
  color: white;
}

.facebook {
  background: #3B5998;
  color: white;
}

.instagram {
  background: #d6249f;
  background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%,#d6249f 60%,#285AEB 90%);
  color: white;
}

.whatsapp {
  background: #4FCE5D;
  color: white;
}



/* Define what each icon button should look like */
.button {
  color: white;
  display: inline-block; /* Inline elements with width and height. TL;DR they make the icon buttons stack from left-to-right instead of top-to-bottom */
  position: relative; /* All 'absolute'ly positioned elements are relative to this one */
  padding: 2px 5px; /* Add some padding so it looks nice */
}

/* Make the badge float in the top right corner of the button */
.button-badge {
  background-color: #fa3e3e;
  border-radius: 2px;
  color: white;
 
  padding: 1px 3px;
  font-size: 20px;
  
  /* position: absolute;  */
  /* Position the badge within the relatively positioned button */
  top: 0;
  right: 0;
}

</style>
</head>


<header>

<div class="jumbotron grad1">
  <div class="topcontainer top-text-center">
    <img src="../images/logo5.png" alt="">
  </div>
</div>

<div class = "navmenu" id="topnav">


    <a href = "index.php"><i class="fas fa-home" ></i>&nbsp;Home</a>

    <div class="dropdown">
      <button  onclick="bookDrop()" class="book_dropbtn"><i class="fas fa-book-open"></i>&nbsp;Categories</button>

        <div id="bookDropdown" class="dropdown-book">
          
          <a href="book.php"><i class="fas fa-book-reader"></i>&nbsp;All Books</a>
          <a href="new_arrival.php"><i class="far fa-bell"></i>&nbsp;New Arrivals</a>
          <a href="english_book.php"><i class="fas fa-star"></i>&nbsp;English Book</a>
          <a href="chinese_book.php"><i class="fas fa-grin-stars"></i>&nbsp;Chinese Book</a>
          <a href="other_book.php"><i class="fas fa-list-ul"></i>&nbsp;Other Book</a>

        </div>
    </div>

    <?php

    if(isset($_SESSION['user_id']))
    {
      $userid = $_SESSION['user_id'];
      $sql = "SELECT * FROM cart WHERE user_id = $userid";
      $result = mysqli_query($connect, $sql);
      $count = mysqli_num_rows($result);

      if(!$result || $count == 0)
      {
        echo'<a href="shopping_cart.php"><i class="fas fa-shopping-cart"></i>&nbsp;Shopping Cart</a>';
      }  
      else
      {
        $total_book = 0;
        while($row = mysqli_fetch_array($result))
        {
          $qty = $row['quantity'];
          $total_book = $total_book + $qty;
        }

        echo'<a href="shopping_cart.php" class="button"><i class="fas fa-shopping-cart"></i>&nbsp;Shopping Cart&nbsp;<span class="button-badge">'.$total_book.'</span></a>';
      }
    }
    else
    {
      echo'<a href="shopping_cart.php"><i class="fas fa-shopping-cart"></i>&nbsp;Shopping Cart</a>';
    }
    ?>
    <a href="contact_us.php"><i class="fas fa-phone"></i>&nbsp;Contact</a>

    <?php
    if(!isset($_SESSION['login_user']))
    {
      echo '<a href="login.php"><i class="fas fa-arrow-circle-right"></i>&nbsp;Login Here</a>';
    }

    else
    {
      $user_name = $_SESSION['login_user'];
      echo '
      <div class="dropdown">
      <button onclick="userDrop()" class="dropbtn">
      <i class="fas fa-user-circle"></i>&nbsp;'.$user_name.'</button>

        <div id="myDropdown" class="dropdown-content">

          <a href="myprofile.php"><i class="fas fa-user-edit"> </i>&nbsp;My Profile</a>
          <a href="myorder.php"><i class="fas fa-box-open"></i>&nbsp;My Order</a>
          <a href="reset_password.php"><i class="fas fa-key"></i>&nbsp;Reset Password</a>
          <a href="logout.php"><i class="glyphicon glyphicon-log-out"></i>&nbsp;Logout</a>

        </div>
      
      </div>
      ';
    }
    
    ?>

</div>

</header>

<body>

<div class="icon-bar">
  <a href="https://www.facebook.com/" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
  <a href="https://www.instagram.com/" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
  <a href="https://www.whatsapp.com/" target="_blank" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
</div>

</body>


<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function userDrop() 
{
  document.getElementById("myDropdown").classList.toggle("show");
}

function bookDrop() 
{
  document.getElementById("bookDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) 
  {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;

    for (i = 0; i < dropdowns.length; i++) 
    {
      var openDropdown = dropdowns[i];

      if (openDropdown.classList.contains('show')) 
      {
        openDropdown.classList.remove('show');
      }
    }
  }

  elseif ( !event.target.matches('.book_dropbtn'))
  {
    var dropdowns = document.getElementsByClassName("dropdown-book");
    var i;

    for (i = 0; i < dropdowns.length; i++)
    {
      var openDropdown = dropsowns[i];

      if (openDropdown.classList.contains('show'))
      {
        opdenDropdown.classList.remove('show');
      }
    }
  }
}
</script>

</html>
