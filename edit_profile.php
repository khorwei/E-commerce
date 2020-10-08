<?php

include("../include/connection.php");
include("session.php");

// $admin = $_SESSION['login_admin'];
// $admin_id = $_SESSION['admin_id'];

// echo $admin;
// echo $admin_id;

if(isset($_POST['edit']))
{
    $admin_id = $_POST['edit'];
}
else
{
    $admin_id = $_SESSION['admin_id'];
}

$sql = "SELECT * FROM admins WHERE admin_id = $admin_id";
$result = mysqli_query($connect, $sql);

if($result)
{
    $row = mysqli_fetch_assoc($result);

    $email = $row['email'];
    $username = $row['username'];
}

if(isset($_POST['update']))
{
    $update_adminid = $_POST['update'];
    $update_email   = mysqli_real_escape_string($connect, $_POST['email']);

    $update = "UPDATE admins SET email = '$update_email' WHERE admin_id = $update_adminid";
    $result = mysqli_query($connect, $update);

    if($result)
    {
        echo '<script> alert("Update Succesfully! \\nEmail: '.$update_email.'.") </script>';
        echo "<meta http-equiv='refresh' content='0'>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="icon" href="../images/logo6.png" type="image/gif" sizes="16x16">
    <title><?php echo $admin ?>'s Profile</title>
</head>

<?php include("header.php") ?>

<style>
div.filled 
{
    text-align: center;
    color: black;
    padding: 20px;
    font-size: 20px;
}

label 
{
    text-align: left;
}
</style>

<body>
    <h2>Add Admin</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="form-container">

        <div class="imgcontainer">
            <img src="../images/add.png" alt="Add Admin" class="avatar">
        </div>

        <div class="container">

            <div class="filled">
                <span>Please make sure all fields are <span style="color:red; font-weight: bold;">FILLED!</span></span>
                <br>
                <span>If the field is <span style="color:red; font-weight: bold;">empty</span>, it will <span style="color:red; font-weight: bold;">remain the same.</span></span>
                <br><br>
            </div>

            <div>
                <label for="username">
                <b>Username (Cannot be changed after adding)*</b>
                </label>
                <br>
                <p class="username"><?php echo $username; ?></p>
                

            </div>

            <div>
                <label for="email">
                <br>
                <b>Email *</b>
                </label>
                <br>
                <input type="email" name="email" placeholder="<?php echo $email ?>" value="<?php echo $email ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                
            </div>
        

            <div class="container">   

                <button type="submit" class="submitbtn" id="button" name="update" value="<?php echo $admin_id; ?>">Update Profile</button>

            </div>
        </div>

    </form>
</body>

<?php include("footer.php") ?>

</html>