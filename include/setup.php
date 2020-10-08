<?php

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname    = "libros";

//create connection
$connect = mysqli_connect($servername, $username, $password, $dbname);

//statement of create database
//object method
if ($connect -> connect_error)
{
        die("Connection failed: " .$connect -> connect_error);
}
else
{
        //echo "<i> DB created! - testing purpose</i>";
}

//CREATE TABLE
//User Table
$user_sql       = "CREATE TABLE IF NOT EXISTS users
                (user_id INT(6) UNSIGNED NOT NULL AUTO_INCREMENT,
                username VARCHAR(30) NOT NULL,
                user_password VARCHAR(180) NOT NULL,
                fullname VARCHAR(30) NOT NULL,
                phone VARCHAR(15) NOT NULL,
                email VARCHAR(50) NOT NULL,
                address VARCHAR(255) NOT NULL,
                city VARCHAR(500) NOT NULL,
                postcode INT(5) NOT NULL,
                state VARCHAR(500) NOT NULL,
                country VARCHAR (500) NOT NULL,
                PRIMARY KEY(user_id),
                CONSTRAINT username UNIQUE (username));";

mysqli_query($connect, $user_sql);

if(!mysqli_query($connect,$user_sql)) 
{
        die(mysqli_error($connect));
        echo "Error from creating USER table!";
}

/* $sql = "DROP TABLE admins";
mysqli_query($connect, $sql); */

//Admin Table
$admin_sql      = "CREATE TABLE IF NOT EXISTS admins
                (admin_id INT(6) UNSIGNED NOT NULL AUTO_INCREMENT,
                username VARCHAR(30) NOT NULL,
                email VARCHAR(50) NOT NULL,
                admin_password VARCHAR(180) NOT NULL,
                PRIMARY KEY(admin_id),
                CONSTRAINT username UNIQUE (username));";

mysqli_query($connect, $admin_sql);

if(!mysqli_query($connect,$admin_sql)) 
{
        die(mysqli_error($connect));
        echo "Error from creating ADMIN table!";
}

//Book Table
$book_sql       = "CREATE TABLE IF NOT EXISTS books
                (book_id INT(6) UNSIGNED NOT NULL AUTO_INCREMENT,
                bookname VARCHAR(200) NOT NULL,
                author VARCHAR(200) NOT NULL,
                price DECIMAL(10, 2) NOT NULL,
                category VARCHAR(50) NOT NULL,
                quantity INT(5) NOT NULL,
                detail VARCHAR(8000) NOT NULL,
                image_path VARCHAR(500) NOT NULL,
                added_date date NOT NULL,
                PRIMARY KEY(book_id));";

mysqli_query($connect, $book_sql);

if(!mysqli_query($connect,$book_sql)) 
{
        die(mysqli_error($connect));
        echo "Error from crating BOOK table!";
}

//Shopping Cart Table
$cart_sql       = "CREATE TABLE IF NOT EXISTS cart
                (cart_id INT(6) UNSIGNED NOT NULL AUTO_INCREMENT,
                user_id INT(6) NOT NULL,
                book_id INT(6) NOT NULL,
                quantity INT(6) NOT NULL,
                total_amount DECIMAL(10,2) NOT NULL,
                PRIMARY KEY (cart_id),
                FOREIGN KEY (user_id) references users(user_id),
                FOREIGN KEY (book_id) references books(book_id));";

mysqli_query($connect,$cart_sql);

if(!mysqli_query($connect, $cart_sql)) 
{
        die(mysqli_error($connect));
        echo "Error from creating CART table!";
}



//Orders Table
$order_sql      = "CREATE TABLE IF NOT EXISTS orders
                (order_id INT(6) UNSIGNED NOT NULL AUTO_INCREMENT,
                user_id INT(6) NOT NULL,
                quantity INT(6) NOT NULL,
                total_amount DECIMAL(10,2) NOT NULL,
                orderdate DATE NOT NULL,
                status VARCHAR(200) NOT NULL,
                ordernum VARCHAR(200) NOT NULL,
                PRIMARY KEY (order_id),
                FOREIGN KEY(user_id) references users(user_id));";
        
mysqli_query($connect, $order_sql);

if(!mysqli_query($connect,$order_sql)) 
{
        die(mysqli_error($connect));
        echo "Error from creating ORDERS table!";
}

//cart_order table
$cart_order   = "CREATE TABLE IF NOT EXISTS cart_order
                (id INT(6) UNSIGNED NOT NULL AUTO_INCREMENT,
                order_id INT(6) NOT NULL,
                book_id INT(6) NOT NULL,
                book_qty INT(6) NOT NULL,
                PRIMARY KEY (id),
                FOREIGN KEY(user_id) references users(user_id),
                FOREIGN KEY (book_id) references books(book_id));";
        
mysqli_query($connect, $cart_order);

if(!mysqli_query($connect, $cart_order)) 
{
        die(mysqli_error($connect));
        echo "Error from creating cart order table!";
}
//Comment Table
$comment_sql = "CREATE TABLE IF NOT EXISTS comments(
                comment_id INT(6) UNSIGNED NOT NULL AUTO_INCREMENT,
                username VARCHAR(30) NOT NULL,
                book_id INT(6) NOT NULL,
                topic VARCHAR(255) NOT NULL,
                comment VARCHAR(5000) NOT NULL,
                datetime DATE NOT NULL,
                PRIMARY KEY (comment_id),
                FOREIGN KEY (book_id) references books(book_id),
                FOREIGN KEY (username) references users(username);";

mysqli_query($connect, $comment_sql);

if(!mysqli_query($connect,$comment_sql)) 
{
        die(mysqli_error($connect));
        echo "Error!";
}

?>