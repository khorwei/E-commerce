<?php

//Initialize the session
session_start();

if(session_destroy())
{
    header('Location: index.php');
}
else
{
    unset($_SESSION['login_user']);
    session_destroy();
    header('Location: index.php');
}

?>