<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src = "https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
/* body 
{
  line-height: normal;
} */

.dropbtn, .book_dropbtn, .user_dropbtn 
{
    font-family: "Trebuchet MS", Helvetica, sans-serif;
    background-color: #366682;
    color: white;
    font-size: 18px;
    border: none;
    cursor: pointer;
    margin: 0;
    padding: 12px 16px;
    letter-spacing: 2px;
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
  font-weight: none;
  padding: 12px 16px;
  font-style: italic;
  cursor: pointer;
  letter-spacing: 2px;
}

.dropbtn:hover, 
.dropbtn:focus, 
.book_dropbtn:hover, 
.book_dropbtn:focus,
.user_dropbtn:hover,
.user_dropbtn:focus 
{
  background-color: #a7b6c9;
  text-decoration: none;
  font-style: italic;
  color: black;
  font-weight: none;
  padding: 10px 16px;
}

.dropdown 
{
  position: relative;
  display: inline-block;
}

.dropdown-content, 
.dropdown-book, 
.dropdown-user 
{
    font-family: "Trebuchet MS", Helvetica, sans-serif;
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    width: 209px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a, 
.dropdown-book a, 
.dropdown-user a 
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
      <button onclick="bookDrop()" class="book_dropbtn"><i class="fas fa-book-open"></i>&nbsp;Books</button>

      <div id="bookDropdown" class="dropdown-book" >

        <a href="booklist.php"><i class="fas fa-list"></i>&nbsp;Book List</a>
        <a href="add_book.php"><i class="far fa-hand-point-right"></i>&nbsp;Add Book</a>
        <a href="booklist.php"><i class="far fa-sad-tear"></i>&nbsp;Delete Book</a>
        <a href="booklist.php"><i class="fas fa-edit"></i> &nbsp;Edit Book</a>

      </div>
    </div>

    <a href="orders.php"><i class="fas fa-shopping-cart"></i>&nbsp;Orders</a>
    <!-- <a href="../user/index.php"><i class="fas fa-users"></i>User View</a> -->

    <div class="dropdown">
      <button onclick="userDrop()" class="user_dropbtn"><i class="fas fa-user-check"></i>&nbsp;Users</button>

      <div id="userDropdown" class="dropdown-user" >

        <a href="user_list.php"><i class="fas fa-list"></i>&nbsp;User List</a>
        <a href="../user/index.php"><i class="fas fa-users"></i>&nbsp;User View</a>

      </div>
    </div>

    <?php

    
    // if (!isset($_SESSION['login_admin']))
    // {
    //   echo"no data";
    // }
    // else{
    //   echo"yes! ";
    // }

    if(!isset($_SESSION['login_admin']))
    {
      echo '<a href="login.php"><i class="fas fa-arrow-circle-right"></i> Login Here</a>';
    }

    else
    {
      
      $user_name = $_SESSION['login_admin'];
      echo '
      <div class="dropdown">
        <button onclick="adminDrop()" class="dropbtn">
        <i class="fas fa-user-circle"></i>&nbsp;'.$user_name.'</button>

        <div id="myDropdown" class="dropdown-content">

          <a href="admin_list.php"><i class="fas fa-user-tie"> </i>&nbsp;Admin List</a>
          <a href="add_admin.php"><i class="fas fa-user-plus"> </i>&nbsp;Add Admin</a>
          <a href="admin_list.php"><i class="fas fa-user-times"></i>&nbsp;Remove Admin</a>
          <a href="edit_profile.php"><i class="fas fa-user-edit"></i>Edit Profile</a>
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

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function adminDrop() 
{
  document.getElementById("myDropdown").classList.toggle("show");
}

function bookDrop() 
{
  document.getElementById("bookDropdown").classList.toggle("show");
}

function userDrop() 
{
  document.getElementById("userDropdown").classList.toggle("show");
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

  elseif ( !event.target.matches('.user_dropbtn'))
  {
    var dropdowns = document.getElementsByClassName("dropdown-user");
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

</body>
</html>
