<?php

//Initialize the session
session_start();

if(session_destroy())
{
    header('Location: login.php');
}
else
{
    unset($_SESSION['login_admin']);
    session_destroy();
    header('Location: login.php');
}

?>