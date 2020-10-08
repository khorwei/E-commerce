<?php

session_start(); 

$admin_check    = $_SESSION['login_admin'];
$admin_id       = $_SESSION['admin_id'];

$select_sql     = "SELECT * FROM admins WHERE username = '$admin_check'";
$result         = mysqli_query($connect, $select_sql);

$row            = mysqli_fetch_array($result, MYSQLI_ASSOC);

$login_session  = $row['username'];
$login_id       = $row['admin_id'];

//if user haven't login, user will be forced to login before go to the website
if(!isset($login_admin) && !isset($login_id))
{
    header('location: logout.php');
} 
?>