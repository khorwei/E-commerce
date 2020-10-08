<?php

session_start(); 


// echo (empty($_SESSION['login_user']));
// echo ($_SESSION['user_id']);
// echo ($_SESSION['login_user']);
// echo"hihihih".(empty($_SESSION['login_id']));

if((empty($_SESSION['login_user']) && (!isset($_SESSION['login_user'])) && (!isset($_SESSION['user_id']))) ){
    
    $_SESSION['message'] = "Please log in first.";
    // header('location: login.php');
} 
?>