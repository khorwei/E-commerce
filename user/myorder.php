<?php

include("../include/connection.php");
include("session.php");

if(!isset($_SESSION['login_user']))
{
    header('Location: login.php');
}

$username = $_SESSION['login_user'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/logo6.png" type="image/gif" sizes="16x16">
    <title><?php echo $username;?>'s' Order</title>
</head>

<?php include("header.php")?>

<style>

.order_list
{
    text-align: center;
    text-decoration: underline;
}

.order_table 
{
    font-family: "Trebuchet MS", Helvetica, sans-serif;
    letter-spacing: 2px;
    border-collapse: collapse;
    width: 75%;
    margin-left: auto;
    margin-right: auto;
    color: black;
}

.order_table th
{
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #366682;
    color: white;
    height: 50px;
}

.order_table td
{
    width:auto;
}

.order_table tr
{
    background-color: #d8e8ed;
}

.order_table td, .order_table th
{
    border: none;
    padding: 8px;
    text-align: center;
}

.order_table td.bookname 
{
    text-align: left;
}

div.empty 
{
    text-align: center;
    font-size: 30px;
    color: black;
    padding: 50px;
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

</style>

<body>
    <h1 class="order_list">My Orders</h1>

    <table class="order_table">
        <tr>
            <th>Order Number</th>
            <th>Book</th>
            <th>Total Books</th>
            <th>Total Amount(RM)</th>
            <th width=150px;>Order Date</th>
            <th>Status</th>
        </tr>

        

    <?php 

    $user_id = $_SESSION['user_id'];
    $book_list = "";
    $dupliacte_order_id = 0;
    //show order list
    // $select_order = "SELECT * FROM orders WHERE user_id = $user_id";
    // $result_order = mysqli_query($connect, $select_order);

    // $select_cartorder = "SELECT * FROM cart_order WHERE user_id = $user_id";
    // $result_cartorder = mysqli_query($connect, $select_cartorder);

    $select_sql =   "SELECT * FROM orders 
                    JOIN cart_order ON (orders.order_id = cart_order.order_id)
                    JOIN books ON (cart_order.book_id = books.book_id)";

    $result     = mysqli_query($connect, $select_sql);

    if($result)
    {
        // echo "omg!!!! i did it!!! :D";

        //cart order got how many row then will display how many row
        while($row = mysqli_fetch_array($result))
        {
            $user_id        = $row['user_id'];
            $ordernum       = $row['ordernum'];
            $bookname       = $row['bookname'];
            $total_book     = $row['order_qty'];
            $book_qty       = $row['book_qty'];
            $total_amount   = $row['total_amount'];
            $orderdate      = $row['orderdate'];
            $status         = $row['status'];
            // echo 'user id ->'.$bookname.' <- user id <br>';

            if($user_id = $_SESSION['user_id'])
            {
                $temp_ordernum;
               
                if( $ordernum != $dupliacte_order_id)
                {
                    echo '<td>'.$ordernum.'</td>';
                    echo '<td class="bookname"> '.$bookname.' <br><strong style="color: red;">(Quantity: '.$book_qty.')</strong></td>';
                    echo '<td>'.$total_book.'</td>';
                    echo '<td>'.$total_amount.'</td>';
                    echo '<td>'.$orderdate.'</td>';
                    echo '<td style="text-transform: uppercase; font-style: italic; font-weight: bold; color:#d40f0f;">'.$status.'</td>';
                    echo '</tr>';

                    $dupliacte_order_id = $ordernum;
                } 
                else 
                {
                    echo '<td></td>';
                    echo '<td  class="bookname">'.$bookname.' <br><strong style="color: red;">(Quantity: '.$book_qty.')</strong></td>';
                    echo '<td>'.$total_book.'</td>';
                    echo '<td>'.$total_amount.'</td>';
                    echo '<td>'.$orderdate.'</td>';
                    echo '<td style="text-transform: uppercase; color:#d40f0f; font-weight: bold; font-style: italic;">'.$status.'</td>';
                    echo '</tr>';
                }
                
            }



            

        }
        echo '</table>';
    }
    else
    {
        echo "<div class='empty'><i class='far fa-sad-tear'></i>&nbsp;Your shopping cart is empty!&nbsp;<i class='far fa-sad-tear'></i></div>";
        
        echo '<div class="shopnow"><a href="book.php"  id="shopnow" onmouseover>Shop Now ?</a></div>';;
    }
    ?>

</body>

<?php include("footer.php") ?>

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

</script>
</html>