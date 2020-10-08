<?php

//include connection file
include("../include/connection.php");
include("session.php");

/*---------  ADD USER --------*/

//Define variables and initialize with empty values
$username = $password = $confirm_password = $email = $phone = $fullname = $address = $city = $postcode = $state = $country = $message = "";

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

    //Validate postcode
    if(empty(trim($postcode))) 
    {
        $postcode_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please enter postcode. (Eg. 58000)';
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
            echo'Problem of insert user into database';
        }
        else 
        {
            $success = 'User "'.$username.'" is added/<br>';
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
h1 
{
    text-align: center;
}

.cancelbtn, .submitbtn
{
    width: 75%;
}

input 
{
    width: auto;
}

.required 
{
    color: red;
}

input[type=text],
input[type=password],
input[type=email],
input[type=number],
input[type=tel],
select,
option
 {
    width: 100%;
    max-width: auto;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
    text-align: center;
}

@media(min-width: 768px)
{
    .container
    {
        width:auto;
    }
}

@media(min-width:1200px)
{
    .container 
    {
        width: auto;
    }
}

@media(min-width: 992px)
{
    .container 
    {
        width:auto;
    }
}


</style>

<?php include("header.php") ?>

<body>
    <h1>Add a New User!</h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="signup" class="form-container">

        <div class="imgcontainer">
            <img src="../images/add.png" alt="Add Admin" class="avatar">
        </div>

            

        <p>Fill out this form to add a new <b>USER</b>!</p>
        <br>
        <p class="required">*Required</p>

        <hr>

        <span class="err-msg"><?php echo $message ?></span>

        <div class="container">

            <!-- Username -->
            <div> 
        

                <label for="username">
                Username *
                <span class="err-msg"><?php echo $username_err;?></span>
                </label>
                <br>
                <input type="text" name="username" placeholder="Enter Username" value="<?php echo $username;?>">
                

            </div>

            <!-- Full Name -->
            <div>

                <label for="fullname">
                Full Name *
                <span class="err-msg"><?php echo $fullname_err?></span>
                </label>
                <br>
                <input type="text" name="fullname" placeholder="First Last">
                
            </div>

            <!-- Email -->
            <div>

                <label for="email">
                Email *
                <span class="err-msg"><?php echo $email_err?></span>
                </label>
                <br>
                <input type="email" name="email" placeholder="email@example.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                <!-- characters followed by an @ sign, followed by more characters, and then a ".". After the "." sign, add at least 2 letters from a to z -->
                
            </div>

            <!-- Phone -->
            <div>

                <label for="phone">
                Phone Number *
                <span class="err-msg"><?php echo $phone_err?></span>
                </label>
                <br>
                <input type="tel" name="phone" placeholder="0123456789" title="0123456789">
                
            </div>

            <!-- Address -->
            <div>

                <label for="address">
                Address *
                <span class="err-msg"><?php echo $address_err?></span>
                </label>
                <br>
                <input type="text" name="address" placeholder="No 26, Jalan PJS 9/26">
                
            </div> 

            <!-- City -->
            <div>

                <label for="city">
                City *
                <span class="err-msg"><?php echo $city_err?></span>
                </label>
                <br>
                <input type="text" name="city" placeholder="Bandar Sunway">
                
            </div> 

            <!-- Postcode -->
            <div>

                <label for="postcode">
                Postcode *
                <span class="err-msg"><?php echo $phone_err?></span>
                </label>
                <br>
                <input type="text" name="postcode" placeholder="Eg. 58000" pattern="[0-9]{5}" title="Eg. 58000">
                
            </div>

            <!-- City -->
            <div>

                <label for="state">
                State *
                <span class="err-msg"><?php echo $state_err?></span>
                </label>
                <br>
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
                <label for="country">
                Country *
                <span class="err-msg"><?php echo $country_err?></span>
                </label>
                <br>
                <input type="text" name="country" id="country" value="Malaysia" placeholder="Malaysia">
            </div>

            <!-- Password -->
            <div>

                <label for="password">
                Password *
                <span class="err-msg"><?php echo $password_err;?></span>
                </label>
                <br>
                <input type="password" name="password" placeholder="Minimum 6 characters">
            
            </div>

            <!-- Confirm Password -->
            <div>

                <label for="confirm-password">
                Confirm Password *
                <span class="err-msg"><?php echo $confirm_password_err;?></span>
                </label>
                <br>
                <input type="password" name="confirm_password" placeholder="Enter Password Again">

            </div>
        </div>

        <!-- Button -->
        <div>
            <button type="reset" class="cancelbtn" name="cancel">Cancel</button>
            <button type="submit" class="submitbtn" name="register">Sign Up</button>
        </div>

    </form>

</body>

<?php include("footer.php") ?>

</html>