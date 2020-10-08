<?php

include("../include/connection.php");
include("session.php");

if(isset($_POST['userview']))
{
    $user_id = $_POST['userview'];

    $select_sql = "SELECT * FROM users WHERE user_id = $user_id";
    $result = mysqli_query($connect, $select_sql);

    if($result)
    {
        $row = mysqli_fetch_assoc($result);
        $username   = $row['username'];
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
        echo 'error with retrieve data from users table :(((';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/logo6.png" type="image/gif" sizes="16x16">
    <title>User(<?php echo $username; ?>)'s Profile</title>
</head>

<?php include("header.php") ?>

<style>
.user_list
{
    text-align: center;
    text-decoration: underline;
}

.user_table 
{
    font-family: "Trebuchet MS", Helvetica, sans-serif;
    letter-spacing: 3px;
    border-collapse: collapse;
    width: 75%;
    font-size: 16px;
    margin-left: auto;
    margin-right: auto;
    color: black;
}

td.col1
{
    padding: 30px 20px;
    text-align: left;
    background-color: #366682;
    color: white;
    height: 50px;
    width: auto;
    text-transform: uppercase;
    font-weight: bold;
}

td.col2
{
    padding: 30px 20px;
    background-color: #d1e1eb;
}

button.backbtn 
{
    text-align: center;
    width: 75%;
    color: white;
    background-color: #ff9500;
    border: 1px solid black;
    font-size: 17px;
    letter-spacing: 4px;
    padding: 10px;
    border-radius: 10px;
    font-weight: bold;
}

div.back 
{
    margin-left: auto;
    margin-right: auto;
    text-align: center;
}

button.backbtn 
{
    background-color: #5ec72a;
    color: white;
    border-radius: 4px;
}

button.backbtn:hover 
{
    background-color: #b6e89e;
    color: #378710;   
}

@media (min-width: 768px)
{
    div.container 
    {
        width: 100%;
    }
}
</style>

<body>
<h1 class="user_list">User List</h1>

<table class="user_table">
    <tr>
        <td class="col1">Username</td>
        <td class="col2"><?php echo $username?></td>
    </tr>
    
    <tr>
        <td class="col1">Full Name</td>
        <td class="col2"><?php echo $fullname?></td>
    </tr>
    
    <tr>
        <td class="col1">Phone Number</td>
        <td class="col2"><?php echo $phone?></td>
    </tr>
    
    <tr>
        <td class="col1">Email Adress</td>
        <td class="col2"><?php echo $email ?></td>
    </tr>
    
    <tr>
        <td class="col1">Adress</td>
        <td class="col2"><?php echo $address?></td>
    </tr>
    
    <tr>
        <td class="col1">City</td>
        <td class="col2"><?php echo $city ?></td>
    </tr>
    
    <tr>
        <td class="col1">State</td>
        <td class="col2"><?php echo $state ?></td>
    </tr>
    
    <tr>
        <td class="col1">Postcode</td>
        <td class="col2"><?php echo $postcode ?></td>
    </tr>
    
    <tr>
        <td class="col1">Country</td>
        <td class="col2"><?php echo $country ?></td>
    </tr>
</table>

<div class="back">
    <form action="user_list.php" class="back">
        <br><br>
        <button class="backbtn">Go Back</button>
    </form>
</div>

</body>

<?php include("footer.php") ?>

</html>