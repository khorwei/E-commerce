<?php
include("../include/connection.php");
include("session.php");


$same = $oldpsw_err = $newpsw_err = $username = "";
$new_password = $old_password = $current_password = "";
$confirm_password = $username_err = "";
$login_user = "";
//Check if the user is already logged in, if yes then redirect him to home page
if(isset($_SESSION['login_user'])) 
{
    $username = $_SESSION['login_user'];
    $user_id = $_SESSION['user_id'];
}

if(!empty($_SESSION['login_user']) && !empty($_SESSION['user_id']) )
{
    $username = $_SESSION['login_user'];
    $user_id = $_SESSION['user_id'];
    $login_user = $_SESSION['login_user'];
    $login_id   = $_SESSION['user_id'];
}

$same = $oldpsw_err = $newpsw_err = $username = "";
$new_password = $old_password = $current_password = "";
$confirm_password = $username_err = "";



if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $temp = $_POST['username'];
    $dup_username = "SELECT * FROM users WHERE username = '$temp'";
    // echo $dup_username;
    $result = mysqli_query($connect, $dup_username);
    $row = mysqli_fetch_assoc($result);
    if(empty($_SESSION['login_user']) && empty($_SESSION['user_id']))
    {
        $login_user = $row['username'];
        $login_id   = $row['user_id'];
    }
    else
    {
        $login_user = $_SESSION['login_user'];
        $login_id   = $_SESSION['user_id'];
    }
    if($result)
    {
   
        if(empty($_POST['username']))
        {
            $username_err = '<br><br><span class="err-msg"><i class="fas fa-exclamation-circle"></i>&nbsp;Please enter your username';
        }
        elseif ($_POST['username'] != $login_user ) 
        {
            // if($count == 1)
            // {
            //     $username_err = '<br><br><span class="err-msg"><i class="fas fa-exclamation-circle"></i>&nbsp;Username is <strong>Incorrect</strong>!';
            // }
            // else
            // {
                $username_err = '<br><br><span class="err-msg"><i class="fas fa-exclamation-circle"></i>&nbsp;Username is <strong>Incorrect</strong>!';
            // }
        }
    }
    else
    {
        $username_err = '<br><br><span class="err-msg"><i class="fas fa-exclamation-circle"></i>&nbsp;<strong>Could Not Find Username!</strong>!';
    }

    if(empty($_POST['current_password']))
    {
        $oldpsw_err = '<br><br><span class="err-msg"><i class="fas fa-exclamation-circle"></i>&nbsp;Please enter your current password';
    }

    if(empty($_POST['new_password']))
    {
        $same = '<br><br><span class="err-msg"><i class="fas fa-exclamation-circle"></i>&nbsp;Please enter a new password';
    }

    if(empty($_POST['confirm_password']))
    {
        $same = '<br><br><span class="err-msg"><i class="fas fa-exclamation-circle"></i>&nbsp;Please confirm your password.';
    }
    // echo ($_POST['current_password']);

    if(!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['confirm_password']) && !empty($_POST['username']))
    {
        $username         = mysqli_real_escape_string($connect, $_POST['username']);
        //the password entered by user
        $current_password = mysqli_real_escape_string($connect, $_POST['current_password']);
        //new password entered by user
        $new_password     = mysqli_real_escape_string($connect, $_POST['new_password']);
        //confirm password for new password
        $confirm_password = mysqli_real_escape_string($connect, $_POST['confirm_password']);

        $confirm_password = md5($confirm_password);
        $new_password     = md5($new_password);
        $current_password = md5($current_password);

        $sql = "SELECT user_password FROM users WHERE user_id = $login_id";

        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);

        //assign the password in database to $old_password
        $old_password = $row['user_password'];

        //check for old password
        //if $current_password is not same as $old_password(database's password)
        if($old_password != $current_password)
        {
            $oldpsw_err = '<br><br><span class="err-msg"><i class="fas fa-exclamation-circle"></i>&nbsp;Incorrect old password</span>';
        }
        
        //if the new password entered by user is same as the password inside database, display error
        if($old_password == $new_password)
        {
            $same = '<br><br><i class="fas fa-exclamation-circle"></i>&nbsp;The new password cannot same as the old password!';
        }

        if($new_password != $confirm_password)
        {
            $newpsw_err = '<br><br><i class="fas fa-exclamation-circle"></i>&nbsp;The new password does not math';
        }

        if($old_password != $new_password)
        {
            if(($old_password == $current_password) && ($new_password == $confirm_password))
            {
                $update_sql = "UPDATE users SET user_password = '$new_password' WHERE user_id = $login_id";
                $result = mysqli_query($connect, $update_sql);

                echo '<script> alert("You password has been changed successfully.") </script>';
                echo("<meta http-equiv='refresh' content='1'>");

                session_destroy();

            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="../css/form.css">
</head>

<?php include("header.php") ?>

<style>
    input
    {
        width:auto;
        max-width: 100%;
    }

    .cancelbtn 
    {
        width: 100%;
    }

    .err-msg
    {
        color: red;
        width: 50px;
    }

    label, input
    {
        color: black;
    }

    p
    {
        color:blue;
    }

    div 
    {
        width:auto;
    }

    @media screen and (min-width: 1200px){
        .container 
        {width:auto;}
        
    }
</style>

<body>



<h2>Change Password Form</h2>

<?php
// echo $login_user.$user_id.'hi';
if(!empty($login_user) && !empty($user_id))
{
    echo'<p>Hi, <strong style="color: green;">'.$login_user.'</strong>! To change password/reset password, please fill out the form below. Please ensure your new password is not same as current password.</p><br><p>You need to login after reseting password successfully.</p>';
}
else
{
    echo'<p>Hello! To change password/reset password, please fill out the form below. Please ensure your new password is not same as current password.</p><br><p>You need to login after reseting password successfully.</p>';
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form-container">

    <div class="imgcontainer">
        <img src="../images/password.png" alt="change_password" class="avatar">
    </div>

    <div class="container">

        <p style="color: red;"><strong>* REQUIRED </strong></p>

        <div>
            <span class="err-msg"><?php echo $username_err ?></span>
            <br>
            <label for="username">
            <b>Username *</b>
            </label>
            <br>
            <input type="text" name="username" id="username" placeholder="Enter Your Username" value="<?php if(!empty($_SESSION['login_user'])){echo $login_user;} ?>">
        </div>

        <div>
            <span class="err-msg"><?php echo $oldpsw_err; ?></span>
            <br>
            <label for="current_password">
            <b>Current Password *</b>
            </label>
            <br>
            <input type="password" name="current_password" id="current_password">
        </div>

        <div>
            <span class="err-msg"><?php echo $same; ?></span>
            <br>
            <label for="new_password">
            <b>New Password *</b>
            </label>
            <br>
            <input type="password" name="new_password" id="new_password">
        </div>

        <div>
            <span class="err-msg"><?php echo $newpsw_err; echo $same; ?></span>
            <br>
            <label for="confirm_password">
            <b>Confirm Password *</b>
            </label>
            <br>
            <input type="password" name="confirm_password" id="confirm_password">
        </div>

        <div>       
            <button type="submit" class="submitbtn" id="button">Submit</button>
            <button type="reset" class="cancelbtn" id="button">Cancel</button>
        </div> 

    </div>

</form>


    
</body>

<?php include("footer.php") ?>

</html>

