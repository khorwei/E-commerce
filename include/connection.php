<?php


$servername = "localhost";
$username   = "root";
$password   = "";

//create connection
$connect = mysqli_connect($servername, $username, $password);

//check connection
if ($connect -> connect_error)
{
    die("Connection failed: " .mysqli_connect_error());
}
else
{
    //echo "<i>Connect sucessfully - testing purpose</i>";
}

//create database
$sql = "CREATE DATABASE libros";
mysqli_query($connect, $sql);

$dbname = "libros";

$connect = mysqli_connect($servername, $username, $password, $dbname);

//statement of create database
if ($connect -> connect_error)
{
    die("Connection failed: " .$connect -> connect_error);
}
else
{
    //echo "<i> DB created! - testing purpose</i>";
}

//mysqli_close($connect);

?>