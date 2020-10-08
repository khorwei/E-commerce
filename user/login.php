<?php

include("../include/connection.php");
//include("../include/footer.php");



//Check if the user is already logged in, if yes then redirect him to home page
if(isset($_SESSION['login_user'])) 
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
        $sql = "SELECT * FROM users WHERE username = '$username' AND user_password='$en_password'";

        //connect
        $result = mysqli_query($connect, $sql);
        $rows = mysqli_num_rows($result);

        if ($rows == 1) 
        {
            $row = mysqli_fetch_array($result);
            $id = $row['user_id'];

            //Initialize the session
            session_start();
            
            //store session data
            $_SESSION['login_user'] = $username;
            $_SESSION['user_id']    = $id;

            header('location: index.php');
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
    <link rel="stylesheet" href="../css/form.css">
    <link rel="icon" href="../images/logo6.png" type="image/gif" sizes="16x16">
    <title>Login</title>
</head>

<?php
include("header.php");
?>

<style>

@media (min-width: 768px)
{
    .container 
    {
        width:auto;
    }
}

.submitbtn {
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

#button:hover,
.cancelbtn:hover {
  opacity: 0.8;
  color: black;
}

</style>

<body>

<h2>Customer Login</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-container">

    <div class="imgcontainer">
        <img src="../images/user.png" alt="User" class="avatar">
    </div>

    <span style="color: red"><?php echo $error_message; //echo $en_password;?></span>

    <div class="container">

        <div>
            <label for="username">
            <b>Username</b>
            </label>
            <br>
            <input type="text" placeholder="Enter Username" name="username" value="<?php echo $username; ?>">
            <span style="color: red"><?php echo $username_err; ?><br></span> 
            <br>
        </div>

        <div>
            <label for="password">
            <b>Password</b>
            </label>
            <br>
            <input type="password" placeholder="Enter Password" name="password">
            <span style="color: red"><?php echo $password_err; ?><br></span>
            <br>
        </div>

        <div>       
            <button type="submit" class="submitbtn" id="button">Login</button>
        </div> 

        <!-- <div>
            <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div> -->

    </div>

    <div class="container" style="background-color:#f1f1f1; letter-spacing: 1px;">

        <button type="reset" class="cancelbtn" id="button">Cancel</button>

        <span class="psw">Forgot <a href="reset_password.php" target="_self" class="new">PASSWORD?</a>

        <br>Not a member? <a href="register.php" target="_self" class="new">Join Now!</a></span>

        

    </div>
</form>

</body>


<?php include("footer.php"); ?>
</html>
