<?php

include("../include/connection.php");



//Check if the admin is already logged in, if yes then redirect him to homepage
//session_start();

if(isset($_SESSION['login_admin']))
{
    header('Location: index.php');
}

//Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
$error_message = "";
$en_password = "";

//Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    //Check if username is empty
    if(empty(trim($username))) 
    {
        $username_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please enter username.';
    }

    //Check if password is empty
    if(empty(trim($password))) 
    {
        $password_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please enter your password.';
    }

    //Validate credentials
    if(empty($username_err) && empty($password_err)) 
    {
        //encrypt the password entered by user
        $en_password = md5($password);


        //Prepare a select statement
        $sql = "SELECT * FROM admins WHERE username = '$username' AND admin_password='$en_password'";

        //connect
        $login = mysqli_query($connect, $sql);

        if (mysqli_num_rows($login) == 1) 
        {
            $row = mysqli_fetch_array($login);
            $id = $row['admin_id'];

            //initialize the session
            session_start();

            //store session data
            $_SESSION['login_admin'] = $username;
            $_SESSION['admin_id']    = $id;

            header('Location: index.php');
        }

        else
        {
            $error_message = '<i class="fas fa-exclamation-circle"></i>&nbsp;Invalid username and password.';
        }
    }
}

?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../images/logo6.png" type="image/gif" sizes="16x16">
<link rel="stylesheet" href="../css/form.css">
<title>Login As Admin</title>

<?php include("header.php"); ?>

<style>



.loginbtn, .cancelbtn 
{
    font-family: "Trebuchet MS", Helvetica, sans-serif;
    background-color: #48d446;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    max-width: auto; 
}

.loginbtn:hover, .cancelbtn:hover 
{
    font-family: "Trebuchet MS", Helvetica, sans-serif;
    background-color: ;
    opacity: 0.8;
    color: black;
}

.cancelbtn {
    width: auto;
    padding: 15px 20px;
    background-color: #f44336;
    letter-spacing: 2px;
}



span a:hover
{
  background-color: #f1f1f1;
  text-decoration: none;
  color: red;
  font-weight: none;
  padding: 0;
  font-style: italic;
  cursor: pointer;
  letter-spacing: 2px;
}

@media (min-width: 768px)
{
    .container 
    {
        width: auto;
    }
}


/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) 
{
    span.psw {
        display: block;
        float: none;
    }
    .cancelbtn {
        width: 100%;
    }
}

.err-msg 
{
    color: red;
}

</style>
</head>

<body>
<div class="content">
<h2 align="center">Admin Login</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-container">

    <div class="imgcontainer">
        <img src="../images/user.png" alt="User" class="avatar">
    </div>
    <span class="err-msg"><?php echo $error_message;?></span>

    <div class="container">

       
        <div class =" <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label for="username"><b>Username</b></label>
            <br>
            <input type="text" placeholder="Enter Username" name="username" class="form-control" value="<?php echo $username; ?>"required>
            <span class="help-block"><?php echo $username_err; ?></span> 
            
        </div>

        <div class="form-group <?php echo(!empty($password_err)) ? 'has-error' : ''; ?>">
            <label for="password"><b>Password</b></label>
            <br>
            <input type="password" placeholder="Enter Password" name="password" required>
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>

        <div>       
            <button type="submit" class="loginbtn">Login</button>
        </div> 

        <!-- <div>
            <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div> -->
    </div>

    <div class="container" style="background-color:#f1f1f1; letter-spacing: 1px;">
        <button type="button" class="cancelbtn">Cancel</button>

        <span class="psw">Forgot <a href="reset_password.php" target="_self" class="new">PASSWORD?</a>

        

    </div>
</form>
</div>

</body>

<?php
include("footer.php");
?>



</html>
