<?php
include("../include/connection.php");
include("session.php");

if(!isset($_SESSION['login_user']))
{
    header('Location: login.php');
}

// echo $_SESSION['login_user'];
// echo $_SESSION['user_id'];

$user_id = $_SESSION['user_id'];

$selectcart  = "SELECT * FROM cart WHERE user_id = $user_id";
$resultcart  = mysqli_query($connect, $selectcart);


$bookname       = $price = $cart_qty = $image_path = "";
$err_msg        = "";
$book_amount    = 0; //the total price for each book
$total_amount   = 0; //total amount will total up all item
$cart_no        = 0; //cart number for each item

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/logo6.png" type="image/png" sizes="16x16">
    <title>Shopping Cart</title>
</head>

<?php include("header.php") ?>

<style>

body 
{
    letter-spacing: 4px;
}

h1
{
    text-align: center;
    color: black;
    letter-spacing: 8px;
    padding: 40px 10px;
    font-size: 40px;
}

p 
{
    text-align:center;
    font-weight: bold;
    color: red;
    font-size: 18px;
}

span.user_name 
{
    text-transform: uppercase;
    color: #7299e0;
}

div.empty 
{
    text-align: center;
    font-size: 30px;
    color: black;
    padding: 50px;
}

div.shopnow 
{
    text-align: center;
}

div.shopnow a
{
    color: white;
    text-align: center;
    font-size: 20px;
    background-color: #328fa8;
    padding: 20px;
    width: auto;
    border-radius: 4px;
}

div.shopnow a:hover
{
    background-color: white;
    color: #328fa8;
    border: 2px solid #328fa8;
}

div.shopnow a:focus 
{
    background-color: #8bd1d6;
    color: white;
    border: 2px solid black;
}

.carttable
{
    font-family: "Trebuchet MS", Helvetica, sans-serif;
    letter-spacing: 3px;
    border-collapse: collapse;
    max-width: 75%;
    min-width: ;
    margin-left: auto;
    margin-right: auto;
    color: black;
}

td, th
{
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
    color: black;
}

.carttable th 
{
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #366682;
    color: white;
    height: 50px;
}

.carttable td 
{
    width:auto;
}

td.col1 
{
    width: auto;
}

td.col2 
{
    min-width: ;
    max-width: ;
    text-align: left;
}

td.col3 
{
    min-width: ;
    max-width: ;
    text-align: center;
}

td.col4 
{
    min-width: ;
    max-width: ;
    text-align: center;
}


div.book-img 
{
    display: inline-block;
    float: left;
    padding: 10px;
}

div.bookdetail 
{
    display: inline-block;
    padding: 15px;
}

span.bookname 
{
    text-transform: uppercase;
    font-size: 18px;
    font-weight: bold;
}

input[type=number]
{
    width: 4em;
    text-align: center;
}

.updatebtn
{
    letter-spacing: 2px;
    background-color: #0D98BA;
    width: auto;
    color: white;
    margin: 10px;
    border: none;
    padding: 10px;
    border-radius: 10px;
}

.removebtn
{
    letter-spacing: 2px;
    background-color: #ba2d0d;
    width: 200px;
    color: white;
    margin: 10px;
    border: none;
    padding: 10px;
    border-radius: 10px;
}

.updatebtn:hover
{
    background-color: #75a4bf;
    font-weight: bold;
    color: #2a5066;
}

.removebtn:hover
{
    background-color: #bf8075;
    font-weight: bold;
    color: #66312a;
}

form.remove 
{
    text-align: center;
}

button.checkout, 
button.clearcart,
button.backbtn 
{
    text-align: center;
    width: 50%;
    color: white;
    background-color: #ff9500;
    border: 1px solid black;
    font-size: 17px;
    letter-spacing: 4px;
    padding: 10px;
    border-radius: 10px;
    font-weight: bold;
}

button.backbtn 
{
    background-color: #5ec72a;
    color: white;
}

button.backbtn:hover 
{
    background-color: #b6e89e;
    color: #378710;   
}

button.clearcart 
{
    background-color: #f0472e;
}

button.checkout:hover 
{
    background-color: #f2af83;
    color: #db6e00;
}

button.clearcart:hover 
{
    background-color: #f08686;
    color: #db0000;
}

div.cartbutton
{
    text-align: center;
    padding: 20px;
    margin: 20px;
}

div.msg 
{
    text-align: center;
    padding: 20px;
    margin: 50px;
    font-size: 18px;
}

</style>

<body>

    <h1><span class="user_name"><?php echo $_SESSION['login_user']?></span>'s Shopping Cart</h1>

    <p><i class='fas fa-exclamation-triangle'></i>&nbsp;Book will be removed automatically if the book is out of stock or not available!</p>

        <?php

        if($resultcart)
        {
            $count      = mysqli_num_rows($resultcart);

            echo '
                <div>
                <table class="carttable">
                    <tr>
                        <th>No</th>
                        <th>Book</th>
                        <th>Quantity</th>
                        <th>Amount (RM)</th>
                    </tr>';
        
            if($count == 0)
            {
                echo "<div class='empty'><i class='far fa-sad-tear'></i>&nbsp;Your shopping cart is empty!&nbsp;<i class='far fa-sad-tear'></i></div>";
                echo '<div class="shopnow"><a href="book.php"  id="shopnow" onmouseover>Shop Now ?</a></div>';
            }
            else
            {
                while($rowcart = mysqli_fetch_array($resultcart))
                {
                    $book_id       = $rowcart['book_id'];
                    $cart_qty      = $rowcart['quantity'];
                    $book_amount   = $rowcart['total_amount'];
                    $cart_no       = $cart_no + 1;
                    // echo'book-> '.$book_id;
                    // echo '<br>';
                    
                    //take book id from table cart to retrieve book's information from books table
                    $selectbook     = "SELECT * FROM books WHERE book_id = $book_id";
                    $resultbook     = mysqli_query($connect, $selectbook);

                    if($resultbook)
                    {
                        //echo'book_id->'.$book_id;
                        $rowbook = mysqli_fetch_array($resultbook);

                        //get the data from book table
                        $bookname   = $rowbook['bookname'];
                        $price      = $rowbook['price'];
                        $image_path = $rowbook['image_path'];
                        $author     = $rowbook['author'];
                        $book_stock = $rowbook['quantity'];
                        $total_amount = $total_amount + $book_amount;

                        
                        

                        // echo'<br>total_amount ='.$total_amount;
                        // echo '<br>cart qty =='.$cart_qty;

                        echo'
                        
                            <tr>
                                <td class="col1">'.$cart_no.'</td>

                                <td class="col2">
                                    <div class="title">
                                        <span class="bookname">'.$bookname.'</span>
                                        '.$book_id.'
                                    </div>

                                    <div class="book-img">
                                        <img src="'.$image_path.'" style = "width:200px; height: 260px;">
                                    </div>

                                    <div class="bookdetail">
                                        <span class="bookdetail"><br><br><i class="far fa-user"></i>&nbsp;&nbsp;Author:&nbsp;'.$author.'
                                        </span>
                                    </div>

                                    <br>

                                    <div class="bookdetail">
                                        <span>
                                        <i class="fas fa-money-bill-alt"></i>&nbsp;Price: &nbsp;RM&nbsp;'.$price.'<br>
                                        </span>
                                    </div>

                                    <div>

                                    <form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post" class="remove">
                                        <br><br><br><br>
                                        <button class="removebtn" name="remove" id="removeBtn" value="'.$book_id.'">Remove Book</button>
                                    </form>
                                    </div>
                                    
                                </td>

                                <td class="col3">
                                    <form method="POST">
                                        <input type="number" name="cart_qty" value="'.$cart_qty.'" min="1" max="'.$book_stock.'">

                                        <br>

                                        <button class="updatebtn" name="updatecart" id="updatebtn" value="'.$book_id.'">Update Cart</button>
                                    </form>
                                </td>

                                <td class="col4">'.$book_amount.'</td>

                        
                            </tr>
                        ';

                    }
                    else
                    {
                        $err_msg = "Problem with select book from book table.";
                    }
                }
                

                echo'
                <tr>
                    <td colspan="3">Total Amount</td>
                    <td>RM&nbsp;'.number_format($total_amount, 2).'</td>
                </tr>
            </table>';
            }
            
        }
        else
        {
            $err_msg = "Problem with selecting item from cart table";
            echo '<span>'.$err_msg.'</span>';
        }

        // echo '<br><br>cart qty -> '.isset($_POST['cart_qty']);
        // echo '<br>update -> '.isset($_POST['updatecart']);



        //echo 'quantity added = '.!isset($_POST['cart_qty']);

        //update cart quantity
        if(isset($_POST['cart_qty']) && isset($_POST['updatecart']))
        {
            $addqty         = $_POST['cart_qty'];
            $update_bookid  = $_POST['updatecart'];
            //echo "<br>book_id ->>>".$book_id;
            //echo "<br>new add -->>".$bookname." + ".$addqty;

            $select_book = "SELECT * from books where book_id = $update_bookid";
            $result_book =mysqli_query($connect, $select_book);

            if($result_book)
            {
                $temp_row = mysqli_fetch_assoc($result_book);
                $price = $temp_row['price'];

                $total = $price * $addqty;
                //echo '<br> book_price RM '.$price;
            }

            $update_cart = "UPDATE cart SET quantity = $addqty, total_amount = $total WHERE book_id = $update_bookid";

            echo '<br>sql => '.$update_cart;

            $updateresult = mysqli_query($connect, $update_cart);

            if($updateresult)
            {
                if(isset($_POST['updatecart']))
                {
                    echo '<script> alert("Your cart has been updated!") </script>';
                    echo("<meta http-equiv='refresh' content='1'>");
                }
                else
                {
                    echo'cant refresh the page';
                }
            }
            else 
            {
                echo'Problem with update the table cart.';
            }
        }
        else
        {
           // echo'Something error with get the new quantity';
        }

        //remove book from cart
        if(isset($_POST['remove']))
        {
            $_SESSION['remove_book'] = $_POST['remove'];
            $remove_bookid = $_SESSION['remove_book'];

            $select_sql = "SELECT * FROM books WHERE book_id = $remove_bookid";
            $result = mysqli_query($connect, $select_sql);
            $row_book = mysqli_fetch_assoc($result);

            $delete_bookname = $row_book['bookname'];

            $delete_sql = "DELETE FROM cart WHERE book_id = $remove_bookid";
            $delete_result = mysqli_query($connect, $delete_sql);

            if($delete_result)
            {
                echo '<script> alert("'.$delete_bookname.' is deleted. Your cart is updated.") </script>';
                echo "<meta http-equiv='refresh' content='0'>";
            }

        }

        
        
    
        if($count > 0)
        {echo'<div class="cartbutton">

            <form action="checkout.php" method="POST">
                <button type="submit" name="checkout" class="checkout" value="'. $_SESSION['user_id'] .'" target="_BLANK">Checkout Now</button>
            </form>
                <br>

            <form action="'.htmlspecialchars($_SERVER["PHP_SELF"]) .'" method="POST">
                <button type="submit" name="clearcart" class="clearcart" value="'.$_SESSION['user_id'].'">Clear Cart</button>
                <span> '.$err_msg .' </span>
            </form>
                <br>
                <form action="book.php">
                    <button class="backbtn">Go Back</button>
                </form>
        </div>';
        }
        else
        {
            echo'<div class="msg"><span>Dont wait for MCO listed, Jom shop ONLINE!</span></div>';
        }
        ?>
    </div>

    <?php 
    
        if(isset($_POST['clearcart']))
        {
            $user_id = $_SESSION['user_id'];
            echo '->'.$user_id.' <-';

            $sql = "DELETE FROM cart WHERE user_id = $user_id";
            $result = mysqli_query($connect, $sql);

            if($result)
            {
                echo 
                '<script> alert("Sucessfully clear shopping cart! :D \nYour cart is empty now.") </script>';
                echo("<meta http-equiv='refresh' content='1'>");
            }
            else
            {
                $err_msg = "Error with delete all row in cart table! :<";
                echo $err_msg;
            }
        }
        else 
        {
            $err_msg = "Error with retrieving user id";
        }

    ?>

    
    
</body>

<!-- JavaScript start here -->
<script type="text/javascript">

        /* for shop now */
document.getElementById("shopnow").onmouseover = function()
{
    changeText()
};

document.getElementById("shopnow").onmouseout = function()
{
    changeBack()
};

function changeText()
{
    var display = document.getElementById("shopnow");
    display.innerHTML = "";
    display.innerHTML = "<i class='far fa-hand-point-right'></i>&nbsp; Shop Now !"
}

function changeBack()
{
    var display = document.getElementById("shopnow");
    display.innerHTML = "";
    display.innerHTML = "Shop Now?";
}

function goBack() {
  window.history.back()
}
</script>

<!-- JavaScript End Here -->

<?php include("footer.php"); ?>
</html>