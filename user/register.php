<?php

//include connection file
include("../include/connection.php");

session_start();

//echo ($_SESSION['login_user']);
if(!empty($_SESSION['login_user']) && isset($_SESSION['login_user'])) 
{
    //echo ($_SESSION['login_user']);
    header('Location: login.php');
}

/*---------  REGISTER USER --------*/

//Define variables and initialize with empty values
$username = $password = $confirm_password = $email = $phone = $fullname = $address = $city = $postcode = $state = $country = "";

//empty error message
$username_err =$password_err = $confirm_password_err = $email_err = $phone_err = $fullname_err = $address_err = $city_err = $postcode_err = $state_err = $country_err = "";

//Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") 
{

    // receive all input values from the form
    $username         = mysqli_real_escape_string($connect, $_POST['username']);
    $email            = mysqli_real_escape_string($connect, $_POST['email']);
    $fullname         = mysqli_real_escape_string($connect, $_POST['fullname']);
    $phone            = mysqli_real_escape_string($connect, $_POST['phone']);
    $address          = mysqli_real_escape_string($connect, $_POST['address']);
    $city             = mysqli_real_escape_String($connect, $_POST['city']);
    $postcode         = mysqli_real_escape_string($connect, $_POST['postcode']);
    $state            = mysqli_real_escape_string($connect, $_POST['state']);
    $country          = mysqli_real_escape_string($connect, $_POST['country']);
    $password         = mysqli_real_escape_string($connect, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($connect, $_POST['confirm_password']);

    //if the field is empty, will prompt the user enter username
    //validate username
    if(empty(trim($username))) 
    {
        $username_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please enter a username.';
    }
    elseif(preg_match('/[^a-zA-Z]/',$username))
    {
        $username_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please enter a VALID username (Only accept letters).';
    }

    //Validate fullname
    if(empty(trim($fullname))) 
    {
        $fullname_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please enter your fullname.';
    }

    //Validate phone
    if(empty(trim($phone))) 
    {
        $phone_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please enter your phone number';
    }
    elseif(preg_match('/[^[0-9]/',$phone))
    {
        $phone_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please enter a VALID phone number (eg.0124558967)';
    }

    //Validate email
    if(empty(trim($email))) 
    {
        $email_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please enter your email address';
    }

    //Validate password
    if(empty(trim($password))) 
    {
        $password_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please enter a password.';
    }

    elseif (strlen(trim($password)) < 6) 
    {
        $password_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Password must have at least 6 characters.';
    }

    //Validate confirm password
    if(empty(trim($confirm_password))) 
    {
        $confirm_password_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please confirm password.';
    }

    elseif (empty($password_err) && ($password != $confirm_password)) 
    {
        $confirm_password_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;The two passwords do not match';
    }

    //Validate address
    if(empty(trim($address))) 
    {
        $address_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please enter your address. (Eg. Block Unit/House No)';
    }

    //Validate city
    if(empty(trim($city))) 
    {
        $city_err = "Please enter a city name. (Eg. Bandar Sunway)";
    }
    elseif(preg_match('/[^a-zA-Z\s]+$/',$city))
    {
        $city_err = "Please enter a VALID city name. (Eg. Bandar Sunway)";
    }

    //Validate postcode
    if(empty(trim($postcode))) 
    {
        $postcode_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please enter postcode. (Eg. 58000)';
    }
    elseif(preg_match('/[^0-9]{5}/',$postcode))
    {
        $postcode_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please enter a VALID postcode. (Eg. 58000)';
    }
    
    //Validate state
    if(empty(trim($state))) 
    {
        $state_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please select a state (Eg. Selangor)';
    }
    
    //validate country
    if(empty(trim($country))) 
    {
        $country_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please select a country (Eg. Malaysia)';
    }
    elseif(preg_match("/[^a-zA-Z]/",$country))
    {
        $country_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please enter a country (Eg. Malaysia)';
    }
    


    /* First chechk the database to make sure
    the username entered by user is not exist iniside the database.
    In this case, we will check for email and username to make sure
    do not have same username and email. */
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";

    $login  = mysqli_query($connect, $user_check_query);
    $user   = mysqli_fetch_array($login);

    if($user)
    {
        if ($user['username'] === $username) 
        {
            $username_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Username already exists.';
        }

        if ($user['email'] === $email)
        {
            $email_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Email already exists.';
        }

        $user_id = $user['user_id'];
    }

    //After checking the error, insert data into database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($fullname_err) && empty($phone_err) && empty($email_err) && empty($address_err) && empty($city_err) && empty($state_err) && empty($postcode_err) && empty($country_err)) 
    {

        //Encrypt the password before saving in the database
        $en_password = md5($password);

        //Prepare an insert statement
        $insert_sql = "INSERT INTO users (username, user_password, fullname, phone, email, address, city, postcode, state, country) VALUES ('$username', '$en_password', '$fullname', '$phone', '$email', '$address', '$city', '$postcode', '$state', '$country')";

        $insert_result = mysqli_query($connect, $insert_sql);

        if(!$insert_result)
        {
            die(mysqli_error($connect));
            echo'EROROROR';
        }

        else
        {
            $user_id = $user['user_id'];

            //store session data
            $_SESSION['login_user'] = $username;
            $_SESSION['user_id']    = $user_id;

            header('Location: index.php');
        }

        
    
 }}
 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Here</title>
    <link rel="stylesheet" href="../css/form.css">
    <link rel="icon" href="../images/logo6.png" type="image/gif" sizes="16x16">
</head>

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
.cancelbtn:hover
{
    padding: 14px 20px;
    background-color: #ff9191;
    color: #fc2323;
    font-weight: bold;
    /* width: 50%; */
}

.cancelbtn 
{
    padding: 14px 20px;
    background-color: #fc2323;
    color: white;
}

.signupbtn 
{
    padding: 14px 20px;
    background-color: #32b851;
    color: white;
}

.signupbtn:hover
{
    padding: 14px 20px;
    background-color: #a6ffac;
    color: #32b851;
    font-weight: bold;
    /* width: 50%; */
}

/* Float cancel button and sigup buttons and add an equal width */
.cancelbtn, .signupbtn 
{
    float: left;
    width: 50%;
    border-radius: 0px;
    padding: 14px 20px;
    font-size: 20px;
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
    .cancelbtn, .signupbtn 
    {
        width: 100%
    }
}

p.login
{
    margin: 50px;
    font-size: 20px;
    text-align: center;
}

p.login a 
{
    color: black;
}

p.login a:hover 
{
    color: red;
    background-color: white;
    padding: 15px 40px;
    font-style: normal;
}

.err-msg
{
    color:red;
}

</style>

<?php 
include("header.php");
?>

<body>
    <h1 class="title">Register as a Member!</h1>

    <p>Please fill in this form to JOIN our family!</p>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="signup">

        <div class="imgcontainer">
            <img src="../images/add-group.png" alt="New User" class="avatar">
        </div>

        <div class="container">

            
            <br>
            <p style="color: red; text-transform: uppercase; font-size: 17px;"><strong>*&nbsp;Required</strong></p>

            <hr class="line">

            <!-- Username -->
            <div> 
        
                <br>
                <span class="err-msg"><?php echo $username_err;?></span>
                <br>
                <label for="username">
                Username (Cannot be changed after registration)*
                </label>
                <input type="text" name="username" placeholder="Enter Username" value="<?php echo $username;?>">

            </div>

            <!-- Full Name -->
            <div>
                
                <br>
                <span class="err-msg"><?php echo $fullname_err?></span>
                <br>
                <label for="fullname">
                Full Name *
                </label>
                <input type="text" name="fullname" placeholder="First Last">
                
            </div>

            <!-- Email -->
            <div>

                <br>
                <span class="err-msg"><?php echo $email_err?><br></span>
                <br>
                <label for="email">
                Email *
                </label>
                <input type="email" name="email" placeholder="email@example.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                <!-- characters followed by an @ sign, followed by more characters, and then a ".". After the "." sign, add at least 2 letters from a to z -->
                
                
                
            </div>

            <!-- Phone -->
            <div>

                <br>
                <span class="err-msg"><?php echo $phone_err?></span>
                <br>
                <label for="phone">
                Phone Number *
                </label>
                <input type="tel" name="phone" placeholder="0123456789" title="0123456789">
                
            </div>

            <!-- Address -->
            <div>

                <br>
                <span class="err-msg"><?php echo $address_err?></span>
                <br>
                <label for="address">
                Address *
                </label>
                <input type="text" name="address" placeholder="No 26, Jalan PJS 9/26">
                
            </div> 

            <!-- City -->
            <div>

                <br>
                <span class="err-msg"><?php echo $city_err?></span>
                <br>
                <label for="city">
                City *
                </label>
                <input type="text" name="city" placeholder="Bandar Sunway">
                
            </div> 

            <!-- Postcode -->
            <div>

                <br>
                <span class="err-msg"><?php echo $postcode_err; ?></span>
                <br>
                <label for="postcode">
                Postcode *
                </label>
                <input type="text" name="postcode" placeholder="Eg. 58000" pattern="[0-9]{5}" title="Eg. 58000">
                
            </div>

            <!-- City -->
            <div>

                <br>
                <span class="err-msg"><?php echo $state_err?></span>
                <br>
                <label for="state">
                State *
                </label>
                <select name="state" id="state">
                    <option value="KualaLumpur">Kuala Lumpur</option>
                    <option value="Selangor">Selangor</option>
                    <option value="Sarawak">Sarawak</option>
                    <option value="Sabah">Sabah</option>
                    <option value="Kelantan">Kelantan</option>
                    <option value="Perlis">Perlis</option>
                    <option value="Johor">Johor</option>
                    <option value="Perak">Perak</option>
                    <option value="Pahang">Pahang</option>
                    <option value="NegeriSembilan">Negeri Sembilan</option>
                    <option value="Penang">Penang</option>
                    <option value="Terengganu">Terengganu</option>
                    <option value="Kedah">Kedah</option>
                    <option value="Melaka">Melaka</option>
                </select>
                
            </div> 

            <!-- Country -->
            <div>
                <br>
                <span class="err-msg"><?php echo $country_err;?></span>
                <br>
                <label for="country">
                Country *
                </label>
                <input type="text" name="country" id="country" value="Malaysia" placeholder="Malaysia">
            </div>

            <!-- Password -->
            <div>

                <br><span class="err-msg"><?php echo $password_err;?></span><br>
                <label for="password">
                Password *
                </label>
                <input type="password" name="password" placeholder="Minimum 6 characters" value="<?php echo $password;?>">
            
            </div>

            <!-- Confirm Password -->
            <div>

                <br><span class="err-msg"><?php echo $confirm_password_err;?></span><br>
                <label for="confirm-password">
                Confirm Password *
                </label>
                
                <br><input type="password" name="confirm_password" placeholder="Enter Password Again" value="<?php echo $confirm_password;?>"><br>
                
                <br>

            </div>

            <!-- Button -->
            <div>
                <button type="reset" class="cancelbtn" name="cancel">Cancel</button>
                <button type="submit" class="signupbtn" name="register">Sign Up</button>
            </div>

            <p class="login"><b><a href="login.php" id="loginnow" onmouseover>Already have an acocunt?</a></b></p>

        </div>

    </form>

<script>
/* for shop now */
document.getElementById("loginnow").onmouseover = function()
{
    changeText()
};

document.getElementById("loginnow").onmouseout = function()
{
    changeBack()
};

function changeText()
{
    var display = document.getElementById("loginnow");
    display.innerHTML = "";
    display.innerHTML = "<i class='far fa-hand-point-right'></i>&emsp;Login Now!&emsp;<i class='far fa-hand-point-left'></i>"
}

function changeBack()
{
    var display = document.getElementById("loginnow");
    display.innerHTML = "";
    display.innerHTML = "Already has an account?";
}
</script>

</body>

<?php include("footer.php") ?>

</html>