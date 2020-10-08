<?php
include('../include/connection.php');
include('session.php');
include('header.php');

if((empty($_SESSION['login_admin'])) && (!isset($_SESSION['login_admin'])))
{
    echo '<script> alert("Please log in first!") </script>';
    header('Locaiton: login.php');
}

//Define varibales and initialize with empty values
$username = $password = $en_password = $email = $message = "";

// Empty error message
$username_err = $email_err = "";




if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $email    = mysqli_real_escape_string($connect, $_POST['email']);
    
    //Validate email
    // if(empty(trim($email))) 
    // {
    //     $email_err = "Email address is <strong> REQUIRED </strong>!";
    // }
    //checking purpose
    // else
    // {
    //     //echo'email address is '.$email;
    // }
    //validate username
    if(empty(trim($username)))
    {
        $username_err = '<br><i class="fas fa-exclamation-circle"></i>&nbsp;Username is <strong> REQUIRED </strong>!';
    }

   
        //Validate email
        if(empty(trim($email))) 
        {
            $email_err = '<br><i class="fas fa-exclamation-circle"></i>&nbsp;Email address is <strong> REQUIRED </strong>!';
        }
        
        if(!empty(trim($username)) && (!empty(trim($email))))
        {
            //checking purpose
            //echo'username is '.$username;
            
            //check duplicate username
            $check_username = "SELECT * FROM admins WHERE username = '$username'";

            $result = mysqli_query($connect, $check_username);

            if($row = mysqli_fetch_array($result))
            {
                $username_err = '<br><span><i class="fas fa-exclamation-circle"></i>&nbsp;Sorry, the username -> "'.$username.'" <- is already existed.</span>';
            }

            else
            {

                //random password
                $password = random_password(6);
                $en_password = md5($password);

                $username = strtolower(str_replace(" ","",$username));

                $insert_sql = "INSERT INTO admins (username, email, admin_password) VALUES ('$username', '$email', '$en_password')";

                $result = mysqli_query($connect, $insert_sql);

                if($result)
                {
                    $message = 'Admin "'.$username.'" is added.<br>
                            The password is <strong>'.$password.' </strong>.<br>
                            Please remember it, it will only show now and not show again. <br><br>';
                }
                else
                {
                    $message = "ERROR";
                }
            }
        }
        else
        {
            echo'<span style="text-align: center;" class="err-msg"><p><i class="fas fa-exclamation-circle"></i>&nbsp;Please enter Username and Email Address!</p></span>';
        }
    

}

function random_password($length)
{
    $psw = "";

    for($i = 0; $i < $length; $i++)
    {
        $psw .= rand(0,9);
    }
    return $psw;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin --- Admin</title>
    <link rel="stylesheet" href="../css/form.css">
    <link rel="icon" href="../images/logo6.png" type="image/gif" sizes="16x16">
</head>

<style>

.rand_pwd
{
    border:1px solid #d7d6d6;
    padding: 10px;
    width: auto;
    margin-bottom: 10px;
    color: red;
}

.err-msg
{
    color: red;
}

h2
{
    text-align : center;
}

@media (min-width: 768px)
{
    .container 
    {
        width: auto;
    }
}

</style>

<body>
    <h2>Add Admin</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="form-container">

        <div class="imgcontainer">
            <img src="../images/add.png" alt="Add Admin" class="avatar">
        </div>

        <span class="err-msg"><?php echo $message ?></span>

        <div class="container">
        <div>

            <label for="username">
            <b>Username (Cannot be changed after adding)*</b> 
            <span class="err-msg">&emsp;<?php echo $username_err; ?> </span>
            </label>
            <br>
            <input type="text" placeholder="Enter Username" name="username">
            <br>
            

        </div>

        <div>
            <label for="email">
            <br>
            <b>Email *</b>
            <span class="err-msg">&emsp;<?php echo $email_err; ?></span>
            </label>
            <br>
            <input type="email" name="email" placeholder="admin@example.com"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
            
        </div>

        <div class="input_pwd">
            <label for="password">
            <b>Password *</b>
            </label>
            <br><br>
            <p class="rand_pwd">Password will be generated automatically.</p>
        </div>
    
        </div>

        <div class="container">   

            <button type="submit" class="submitbtn" id="button">Create Account</button>

        </div>

    </form>
</body>

<?php include("footer.php"); ?>

</html>