<?php

include("../include/connection.php");
include("session.php");

if(!isset($_SESSION['login_user']))
{
    header('Location: login.php');
}

$username = $_SESSION['login_user'];
$user_id  = $_SESSION['user_id'];
$msg = "";

$select_sql = "SELECT * FROM users WHERE user_id = $user_id";
$select_result = mysqli_query($connect, $select_sql);

if($select_result)
{
    $row = mysqli_fetch_assoc($select_result);
     
    $fullname   = $row['fullname'];
    $phone      = $row['phone']; 
    $email      = $row['email'];
    $address    = $row['address'];
    $city       = $row['city'];
    $state      = $row['state'];
    $postcode   = $row['postcode'];
    $country    = $row['country'];

}
else
{
    echo "Error!!!! select information ftom user table fail :<<<";
}


if(isset($_POST['update']))
{
    $updateuser_id     = $_POST['update'];
    $update_fullname   = mysqli_real_escape_string($connect, $_POST['fullname']) ;
    $update_phone      = mysqli_real_escape_string($connect, $_POST['phone']) ;
    $update_email      = mysqli_real_escape_string($connect, $_POST['email']) ;
    $update_address    = mysqli_real_escape_string($connect, $_POST['address']) ;
    $update_city       = mysqli_real_escape_string($connect, $_POST['city']) ;
    $update_state      = mysqli_real_escape_string($connect, $_POST['state']) ;
    $update_postcode   = mysqli_real_escape_string($connect, $_POST['postcode']) ;
    $update_country    = mysqli_real_escape_string($connect, $_POST['country']) ;

    $msg = "";

    //Validate fullname
    if(empty(trim($fullname))) 
    {
        $update_fullname = $fullname;
    }
    else
    {
        $update_fullname;
    }

    $update_sql    = "UPDATE users SET fullname = '$update_fullname' WHERE user_id = $updateuser_id";
    $update_result = mysqli_query($connect, $update_sql);

    if($update_result)
    {
        $msg .= "\\n\\nFullname =".$update_fullname;
        // echo "<meta http-equiv='refresh' content='0'>";
    }
    else
    {
        echo "Cant Update FULLNAME !:<";
    }

    //Validate phone
    if(empty(trim($phone))) 
    {
        $update_phone = $phone;
    }
    else
    {
        $update_phone;
    }

    $update_sql    = "UPDATE users SET phone = '$update_phone' WHERE user_id = $updateuser_id";
    $update_result = mysqli_query($connect, $update_sql);

    if($update_result)
    {
        $msg .= "\\nPhone =".$update_phone;
        // echo "<meta http-equiv='refresh' content='0'>";
    }
    else
    {
        echo "Cant Update PHONE !:<";
    }

    //Validate email
    if(empty(trim($email))) 
    {
        $update_fullname = $fullname;
    }
    else
    {
        $update_fullname;
    }

    $update_sql    = "UPDATE users SET email = '$update_email' WHERE user_id = $updateuser_id";
    $update_result = mysqli_query($connect, $update_sql);

    if($update_result)
    {
        $msg .= "\\nEmail =".$update_email;
        // echo "<meta http-equiv='refresh' content='0'>";
    }
    else
    {
        echo "Cant Update EMAIL !:<";
    }

    //Validate address
    if(empty(trim($address))) 
    {
        $update_address = $address;
    }
    else
    {
        $update_address;
    }
    

    $update_sql    = "UPDATE users SET address = '$update_address' WHERE user_id = $updateuser_id";
    $update_result = mysqli_query($connect, $update_sql);

    if($update_result)
    {
        $msg .= "\\nAddress =".$update_address;
        // echo "<meta http-equiv='refresh' content='0'>";
    }
    else
    {
        echo "Cant Update ADDRESS !:<";
    }

    //Validate city
    if(empty(trim($city))) 
    {
        $update_city = $city;
    }
    else
    {
        $update_city;
    }

    $update_sql    = "UPDATE users SET city = '$update_city' WHERE user_id = $updateuser_id";
    $update_result = mysqli_query($connect, $update_sql);

    if($update_result)
    {
        $msg .= "\\nCity =".$update_city;
        // echo "<meta http-equiv='refresh' content='0'>";
    }
    else
    {
        echo "Cant Update CITY !:<";
    }

    //Validate postcode
    if(empty(trim($postcode))) 
    {
        $update_postcode = $postcode;
    }
    else
    {
        $update_postcode;
    }

    $update_sql    = "UPDATE users SET postcode = '$update_postcode' WHERE user_id = $updateuser_id";
    $update_result = mysqli_query($connect, $update_sql);

    if($update_result)
    {
        $msg .= "\\nPhone =".$update_postcode;
        // echo "<meta http-equiv='refresh' content='0'>";
    }
    else
    {
        echo "Cant Update POSTCODE !:<";
    }
    
    //Validate state
    if(empty(trim($state))) 
    {
        $update_state = $state;
    }
    else
    {
        $update_state;
    }

    $update_sql    = "UPDATE users SET state = '$update_state' WHERE user_id = $updateuser_id";
    $update_result = mysqli_query($connect, $update_sql);

    if($update_result)
    {
        $msg .= "\\nState =".$update_state;
        // echo "<meta http-equiv='refresh' content='0'>";
    }
    else
    {
        echo "Cant Update STATE !:<";
    }
    
    //validate country
    if(empty(trim($country))) 
    {
        $update_country = $country;
    }
    else
    {
        $update_country;
    }

    $update_sql    = "UPDATE users SET country = '$update_country' WHERE user_id = $updateuser_id";
    $update_result = mysqli_query($connect, $update_sql);

    if($update_result)
    {
        $msg .= "\\nCountry =".$update_country;
    }
    else
    {
        echo "Cant Update COUNTRY !:<";
    }

    if($update_result)
    {
        echo '<script> alert("Update Succesfully! '.$msg.'") </script>';
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
    <title><?php echo $username?>'s Profile</title>
</head>

<?php include("header.php")?>

<style>

body 
{
    font-family: "Trebuchet MS", Helvetica, sans-serif;
    letter-spacing: 2px;
}

h1.title
{
    text-align: center;
    color: black;
    margin: 20px;
}

* 
{
    box-sizing: border-box;
}

/* Full-qidth input fields */
input[type=text]:focus, input[type=password]:focus 
{
    background-color: #ddd;
    outline: none;
}

/* horizontal line */
hr 
{
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
    color: black;
}

/* Set a style for all buttons */
button 
{
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}

button:hover 
{
    opacity: 0.8;
}

/* Extra styles for the cancel button */

.signupbtn:hover
{
    padding: 14px 20px;
    background-color: #a6ffac;
    color: #32b851;
    font-weight: bold;
    /* width: 50%; */
}

.signupbtn 
{
    width: 100%;
    border-radius: 0px;
    padding: 14px 20px;
    font-size: 18px;
    padding: 14px 20px;
    background-color: #32b851;
    color: white;
}

/* Add padding to container elements */
.container 
{
    padding: 16px;
}

/* Clear floats */
.clearfix::after 
{
    content: "";
    clear: both;
    display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) 
{
    .signupbtn 
    {
        width: 100%
    }
}

@media (min-width: 768px)
{
    div.container 
    {
        width: 100%;
    }
}

div.filled 
{
    text-align: center;
    color: black;
    padding: 20px;
    font-size: 20px;
}

div.container 
{
    left: 50%;
}
</style>

<body>
    <h1 class="title"><?php echo $username; ?>'s Profile</h1>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="update"  class="form-container">

        <div class="imgcontainer">
            <img src="../images/refresh.png" alt="New User" class="avatar">
        </div>

        <div class="container">

            
            <br>
            
            <div class="filled">
                <span>Please make sure all fields are <span style="color:red; font-weight: bold;">FILLED!</span></span>
                <br>
                <span>If the field is <span style="color:red; font-weight: bold;">empty</span>, it will <span style="color:red; font-weight: bold;">remain the same.</span></span>
                <br>
            </div>

            <hr class="line">

            <!-- Username -->
            <div> 
        

                <label for="username">
                Username (Cannot be changed) *
                </label>
                <p class="username"><?php echo $username; ?></p>

            </div>

            <!-- Full Name -->
            <div>

                <label for="fullname">
                Full Name *
                </label>
                <input type="text" name="fullname" placeholder="<?php echo $fullname;?>" value="<?php echo $fullname;?>">
                
            </div>

            <!-- Email -->
            <div>

                <label for="email">
                Email *
                </label>
                <input type="email" name="email" placeholder="<?php echo $email; ?>" value="<?php echo $email; ?>"pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                <!-- characters followed by an @ sign, followed by more characters, and then a ".". After the "." sign, add at least 2 letters from a to z -->
                
            </div>

            <!-- Phone -->
            <div>

                <label for="phone">
                Phone Number *
                </label>
                <input type="tel" name="phone" placeholder="<?php echo $phone ?>" title="<?php echo $phone ?>" value = "<?php echo $phone ?>">
                
            </div>

            <!-- Address -->
            <div>

                <label for="address">
                Address *
                </label>
                <input type="text" name="address" placeholder="<?php echo $address; ?>" value="<?php echo $address; ?>">
                
            </div> 

            <!-- City -->
            <div>

                <label for="city">
                City *
                </label>
                <input type="text" name="city" placeholder="<?php echo $city; ?>" value="<?php echo $city; ?>">
                
            </div> 

            <!-- Postcode -->
            <div>

                <label for="postcode">
                Postcode *
                </label>
                <input type="text" name="postcode" placeholder="<?php echo $postcode; ?>" pattern="[0-9]{5}" title="<?php echo $postcode; ?>" value="<?php echo $postcode; ?>">
                
            </div>

            <!-- State -->
            <div>

                <label for="state">
                State *
                </label>
                <input type="text" name="state" placeholder="<?php echo $state; ?>" value="<?php echo $state; ?>">
                
            </div> 

            <!-- Country -->
            <div>
                <label for="country">
                Country * (We only provide Malaysia)
                </label>
                <input type="text" name="country" id="country" value="<?php echo $country ?>" placeholder="<?php echo $country ?>">
            </div>


            <!-- Button -->
            <div class="container" style="background-color:#f1f1f1; letter-spacing: 1px;">
                <button type="submit" onclick= "msgFunction()" class="signupbtn" name="update" value="<?php echo $user_id; ?>">Update Profile</button>
            </div>

        </div>

    </form>



</body>

<?php include("footer.php"); ?>

<script>

</script>

</html>