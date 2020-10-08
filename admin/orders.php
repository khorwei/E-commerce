<?php

include("../include/connection.php");
include("session.php");

?>

<?php 
$order_err = "";
if(isset($_POST['update']))
{
    $update_ordernum = $_POST['update'];
    $update_status   = $_POST['status'];
    // echo $update_ordernum; 
    // echo $update_status;

    if(empty($update_status))
    {
        $order_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;<span style="color: black;">'.$update_ordernum.'</span>&nbsp;Please enter a status (Processing, Fail, Delivering, Received).';
    }
    elseif(preg_match('/[^a-zA-Z]/',$update_status))
    {
        $order_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;<span style="color: black;">'.$update_ordernum.'</span>&nbsp;Please enter a VALID status.';
    }

    if(empty($order_err))
    {
        $update_sql = "UPDATE orders SET status = '$update_status' WHERE ordernum = $update_ordernum";
        $update_result = mysqli_query($connect, $update_sql);

        if($update_result)
        {
            echo '<script> alert("Status has been updated! :D") </script>';
            echo("<meta http-equiv='refresh' content='1'>");
        }
        else
        {
            echo 'Error with update status!';
        }
    }
}



?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/logo6.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="../css/form.css">
    <title>Orders --- Admin</title>
</head>

<?php include("header.php") ?>

<style>

.order_list
{
    text-align: center;
    text-decoration: underline;
    color: black;
    padding: 30px;
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

.submitbtn 
{
    letter-spacing: 5px;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    background-color: #00a846;
    padding: 10px;
    color: #fff;
}

.submitbtn:hover
{
    color: black;
    background-color: #58cc9c;
}

.button 
{
    width: auto;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
    border-radius: 4px;
}

input 
{
    border-radius: 10px;
    letter-spacing: 2px;
}

input:focus 
{
    background-color: #becded;
    color: #3a7385;
    font-weight: bold;
    letter-spacing: 2px;
}

.err-msg 
{
    color: red;
    text-align: center;
    padding: 30px;
}
</style>

<body>

<body>
    <h1 class="order_list">Order List</h1>

    <div class="err-msg" style="text-align: center;">
        <span class="err-msg"><?php echo $order_err ?></span>
    </div>
    
    <table class="order_table">
    
        <tr>
            <th>Order Number</th>
            <th width=400px;>Book</th>
            <th width=70px;>Total Books</th>
            <th width=120px;>Total Amount(RM)</th>
            <th>Order Date</th>
            <th width=160px;>Status</th>
            <th width=100px;>Action</th>
        </tr>

          

    <?php 

    $admin_id = $_SESSION['admin_id'];
    $book_list = "";
    $dupliacte_order_id = 0;
    $orderarray = [];

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
            $status         = strtoupper($status);
            // echo 'user id ->'.$bookname.' <- user id <br>';

            if($admin_id = $_SESSION['admin_id'])
            {
               
                if( $ordernum != $dupliacte_order_id)
                {
                    echo '<td>'.$ordernum.'</td>';
                    echo '<td class="bookname">'.$bookname.' <br><strong style="color: red;">(Quantity: '.$book_qty.')</strong></td>';
                    echo '<td>'.$total_book.'</td>';
                    echo '<td>'.$total_amount.'</td>';
                    echo '<td>'.$orderdate.'</td>';
                    echo '<td style="text-transform: uppercase;">
                    <form action="'.htmlspecialchars($_SERVER["PHP_SELF"]) .'" method="post">
                        <input type="text" name="status" placeholder="'.$status.'" value="'.$status.'" 
                        
                        </td>
                        <td>
                        <div class="button">
                            <button type="submit" class="submitbtn" name="update" id="submit" value="'.$ordernum.'">Update</button>
                        </div>
                    </form>
                        </td>
                        ';
                    echo '</tr>';

                    $dupliacte_order_id = $ordernum;
                } 
                else 
                {
                    echo '<td></td>';
                    echo '<td class="bookname">'.$bookname.' <br><strong style="color: red;">(Quantity: '.$book_qty.')</strong></td>';
                    echo '<td>'.$total_book.'</td>';
                    echo '<td>'.$total_amount.'</td>';
                    echo '<td>'.$orderdate.'</td>';
                    echo '<td style="text-transform: uppercase;">
                    <form action="'.htmlspecialchars($_SERVER["PHP_SELF"]) .'" method="post">
                        <input type="text" name="status" placeholder="'.$status.'" value="'.$status.'" </td>
                        ';
                    echo '<td></td>';
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

    </form>



    
</body>

<?php include("footer.php") ?>

</html>