<?php

include("../include/connection.php");
include("session.php");

// if(!isset($_SESSION['login_user'])) 
// {
//     header('Location: login.php');
// }

date_default_timezone_set("Asia/Singapore");

$book_id = $bookname = $author = $price = $category = $quantity = $detail = $imgae_path = $added_date = "";
$book_id_err = "";
$error = "";

$comment = $topic = $datetime = "";

if(isset($_POST['view']))
{
$_SESSION['book_id'] = $_POST['view'];
//echo"1st = ".$_POST['view'];
//echo" 2nd = ".$_SESSION['book_id'];
}

if(isset($_SESSION['book_id']))
{
    //echo" 3rd = ".$_SESSION['book_id'];
    //$_SESSION['temp_book'] = $_POST['view'];
    $temp = $_SESSION['book_id'];
    $sql = "SELECT * FROM books WHERE book_id = $temp";

    $temp_result = mysqli_query($connect, $sql);

    $temp_row = mysqli_fetch_array($temp_result);

    $bookname1 = $temp_row['bookname'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $bookname1; ?> --- Detail</title>
    <link rel="icon" href="../images/logo6.png" type="image/gif" sizes="16x16">
</head>

<?php
include("header.php");
?>

<style>
body{
    font-family: "Trebuchet MS", Helvetica, sans-serif;
    letter-spacing: 4px;
}

h1{
    margin: 10px;
    margin-top: 30px;
    padding: 20px 40px;
    left: 50%;
    text-align: center;
    color: green;
    font-size: 40px;
}

.img-container 
{
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
}

.container 
{
    padding-right: 50px;
    padding-left: 50px;
}

.detail 
{
    padding: 50px;
    font-size: 18px;
}

table 
{
    border-collapse: collapse;
    width: 100%;
    letter-spacing: 2px;
}

td 
{
    text-align: left;
    padding: 18px;
    line-height: 200%;
    font-size: 18px;
}

tr:nth-child(even)
{
    background-color: none;
}

th {
  background-color: #4CAF50;
  color: white;
}

.col1 
{
    min-width: 50%;
    max-width: 100%;
    font-weight: bold;
    color: #5fa5c2;
    text-transform: uppercase;
    width: 200px;
    font-size: 20px;
}

.addbutton 
{
    padding: 50px;
    background-color: #e1faf7;
}

#quantity 
{
    width: 90px;
    padding-left: 20px;
}

label 
{
    color: #2c5950;
}

input[type=number]
{
    background-color: white;
    border: 1px solid #9dcfc9;
    text-align: center;
    padding: 5px;
}

input[type=number]:focus 
{
    background-color: #b4e0cb;
    border: 1px solid white;
    color: 1;
}

button.addcart, button.backbtn 
{
    letter-spacing: 2px;
    border: none;
    background-color: #2c5950;
    color: #8dd6c8;
    border-radius: 8px;
    transition-duraiton: 0.4s;
    width: 50%;
    padding: 10px;
    font-weight: bold;
}

button.backbtn 
{
    width: 100%;
    margin: 20px 0;
    background-color: #5ec72a;
    color: white;
    cursor: pointer;   
}

button.backbtn:hover 
{
    background-color: #b6e89e;
    color: #378710; 
}

button.addcart:hover
{
    background-color: #8dd6c8;
    color: #2c5950;
}
button.addcart:focus 
{
    background-color: #74b8b0;
    color: #ffffff;
}

div button.addcart 
{
    text-align: center;
    float:right;
    margin-left: -50%;
    margin-right: 1em;
}

button.outstock 
{
    letter-spacing: 2px;
    border: none;
    background-color: #8dd6c8;
    color: #2c5950;
    border-radius: 8px;
    transition-duraiton: 0.4s;
    width: 50%;
    padding: 10px;
    text-align: center;
    float:right;
    margin-left: -50%;
    margin-right: 1em;
}



</style>



<body>

    <div class="container">
        

            <?php

            if(isset($_SESSION['book_id']))
            {
                //echo($_POST['view']);
                $book_id             = $_SESSION['book_id'];
                // echo $book_id." hello";
                
                $select_book = "SELECT * FROM books where book_id = $book_id";
                $select_result = mysqli_query($connect, $select_book);
                // echo $select_book;

                $row = mysqli_fetch_assoc($select_result);

                $book_id    = $row['book_id'];
                $bookname   = $row['bookname'];
                $author     = $row['author'];
                $price      = $row['price'];
                $category   = $row['category'];
                $image_path = $row['image_path'];
                $quantity   = $row['quantity'];
                $added_date = $row['added_date'];
                $detail     = $row['detail'];

                if ($quantity > 0 )
                {          
                    echo'
                    <div>
                        <h1>'.$bookname.'</h1>
                    </div>
                    ';
                }  
                else
                {
                    echo'
                    <div>
                        <h1>'.$bookname.'</h1>
                        
                        <h3 style="text-align: center; color: #6199ba; font-size: 20px; padding-top: 5px;"><i class="far fa-sad-cry"></i><strong>&nbsp;OUT OF STOCK&nbsp;</strong><i class="far fa-sad-cry"></i></h3>
                    </div>
                    ';
                }

                echo '
                <div class="panel-body">
                    <img src="'.$image_path.'"  class="img-container" style="width:400px; height:450px;">';

                
            

                echo'
                <div class="detail">

                <div class="moredetail">
                    <table class="booktable">
                        <tr>
                            <td class="col1">Bookname &emsp;: </td>
                            <td>'.$bookname.'</td>
                        </tr>
        
                        <tr>
                            <td class="col1">Author &emsp;&emsp;&nbsp;: </td>
                            <td>'.$author.'</td>
                        </tr>

                        <tr>
                            <td class="col1">Category &emsp;&nbsp;: </td>
                            <td>'.$category.'</td>
                        </tr>

                        <tr>
                            <td class="col1">Price &emsp;&emsp;&emsp;&ensp;: </td>
                            <td>RM '.$price.' </td>
                        </tr>';

                    if($quantity > 0)
                    {
                        echo'
                        <tr>
                            <td class="col1">Stock &emsp;&emsp;&emsp;&nbsp;: </td>
                            <td>'.$quantity.'</td>
                        </tr>';
                    }
                    else 
                    {
                        echo'
                        <tr>
                            <td class="col1">Stock &emsp;&emsp;&emsp;&nbsp;: </td>
                            <td><strong>OUT OF STOCK! </strong></td>
                        </tr>';
                    }

                    echo'
                        <tr>
                            <td class="col1">Description : </td>
                            <td>'.$detail.'</td>
                        </tr>

                    </table>

                    <div >
                        <form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="POST">
                            <div class="addbutton">
                                <div>
                                <label for="qty">
                                    Quantity
                                </label>
                                
                                <input type="number" name="quantity" id="quantity" min="1" value="1" max="'.$quantity.'">';
                            
                    if($quantity > 0)
                    {
                        echo'
                        <button class="addcart" name="addcart" id="addcart"  value="'.$book_id.'">Add to Cart</button>

                                
                                
                                </div>
                            </form>
                            
                        </div>
                        <br>
                        <button onclick="goBack()" class="backbtn">Go Back</button>';
                    }
                    else
                    {
                        echo'
                        <button class="outstock" name="outstock" id="outstock" value="">OUT OF STOCK</button>

                                
                                
                                </div>
                            </form>
                        </div>
                        <br>
                        <button onclick="goBack()" class="backbtn">Go Back</button>';
                        echo $error;

                    }


            }
            else
            {
                $error = "Can't obtain book id ! :(";
            }

                


                
            if(isset($_POST['addcart']) && isset($_POST['quantity']))
            {
                //echo "book_id is ".$_POST['addcart'];
                //echo "quantity is ".$_POST['quantity'];

                $add_bookid  = $_POST['addcart'];
                $addqty      = $_POST['quantity'];
                
                if($add_bookid == $book_id)
                {
                    //echo "<br>SAMEEEEEEE<br>";
                }
                else 
                {
                    $error =  'BOOK_ID IS NOT SAME!';
                }


                if(!empty($_SESSION['user_id']))
                {
                    $book_sql = "SELECT * FROM books WHERE book_id = $add_bookid";
                    $result1  = mysqli_query($connect, $book_sql);
                    $book_row = mysqli_fetch_array($result1);

                    
                    $book_price = $book_row['price'];
                    //echo "book price->".$book_price;
                    $book_qty   = $book_row['quantity'];

                    //total amount is for the take the book qty * price, total amount of the book he added at that time
                    $total_amount = $addqty * $book_price;
                    $user_id = $_SESSION['user_id'];

                    $check_cart = "SELECT * FROM cart WHERE book_id = $add_bookid";

                    $check_result = mysqli_query($connect, $check_cart);
                    
                    if($check_result)
                    {
                        $check_count = mysqli_num_rows($check_result);
                        $check_row   = mysqli_fetch_array($check_result);
                        $original_qty = $check_row['quantity'];
                        $addqty = $addqty + $original_qty;
                        
                        if($check_count == 0 && $addqty <= $quantity)
                        {
                            $cart_sql = "INSERT INTO cart (user_id, book_id, quantity, total_amount) VALUES ('$user_id', '$add_bookid', '$addqty','$total_amount')";

                            //echo $cart_sql;

                            $cart_result = mysqli_query($connect, $cart_sql);

                            if($cart_result)
                            {
                                echo '
                                <script> 
                                    alert("'.$bookname.' has been added into shopping cart.")
                                </script>';
                                echo("<meta http-equiv='refresh' content='1'>");
                            }
                            else 
                            {
                                $error =  "Fail to add to cart :<";
                            }
                        }
                        elseif($check_count > 0 && $addqty <= $quantity)
                        {
                            $cart_sql = "UPDATE cart SET quantity = $addqty WHERE book_id = $add_bookid";

                            $cart_result = mysqli_query($connect, $cart_sql);
                            if($cart_result)
                            {
                                echo '
                                <script> 
                                    alert("'.$bookname.' has been added into shopping cart.")
                                </script>';
                                echo("<meta http-equiv='refresh' content='1'>");
                            }
                            else 
                            {
                                $error =  "There is a problem with adding to cart :(((";
                            }
                        }
                        elseif($addqty >= $quantity)
                        {
                            $error = "We only have ".$quantity." in our stock and you have been added into cart.";
                        }
                        else
                        {
                            $error =  "Some error with counting row that has same book id inside cart table! :'(";
                        }
                    }
                    else
                    {
                        $error =  "Error with searching same book_id from book table :'[";
                    }
                    
                }
                else
                {
                    echo '<script> alert("Please login first!") </script>';
                }
                
            }
            else
            {
                //echo"Error with getting data from add quantity! :'<";
            }
                

            ?>
               

            
        </div>
        </div>
        </div>
        </div>
        

        <?php
        $select_comment = "SELECT * FROM comments WHERE book_id = $book_id";
        $comment_result = mysqli_query($connect, $select_comment);
        
        if($comment_result)
        {
            $total_comment = mysqli_num_rows($comment_result);

            if($total_comment > 0)
            {
                echo '<table>';
                while($comment_row = mysqli_fetch_array($comment_result))
                {
                    $topic = $comment_row['topic'];
                    $comment = $comment_row['comment'];
                    $username = $comment_row['username'];
                    $datetime = $comment_row['datetime'];

                    echo
                    '
                    <tr>
                        <td>Username</td>
                        <td>'.$username.'</td>
                    </tr>

                    <tr>
                        <td>Date</td>
                        <td>'.$datetime.'</td>
                    </tr>

                    <tr>
                        <td colspan="2">'.$topic.'</td>
                    </tr>

                    <tr>
                        <td colspan="2">'.$comment.'</td>
                    </tr>
                    ';
                }
                echo '</table>';
            }
            else
            {
                echo '<span>No comment.</span>';
            }
            
            if(empty($_SESSION['login_user']))
            {
                $username ="";
            }
            else
            {
                $username = $_SESSION['login_user'];
            
            // it will display a form to let user comment
                echo
                '
                <form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">

                <table>
                    <h1>Comment Here!</h1>
                    <tr>
                        <td>Username</td>
                        <td><input type="text" name="username" id="username" value="'.$username.'"></td>
                    </tr>

                    <tr>
                        <td>Topic</td>
                        <td><input type="text" name="topic" id="topic"></td>
                    </tr>

                    <tr>
                        <td>Comment</td>
                        <td><textarea type="text" name="comment" id="comment"></textarea></td>
                    </tr>
                </table>

                    <button id="submit_comment" name="submit_comment" value="'.$book_id.'">Submit Comment</button>
                
                </form>';
            }
        }
        else
        {
            echo "Problem with retrieve all comments!";
        }

        if(isset($_POST['submit_comment']))
        {
            $commentbook_id     = $_POST['submit_comment'];
            $comment_username   = mysqli_real_escape_string($connect, $_POST['username']);
            $comment_book       = mysqli_real_escape_string($connect, $_POST['comment']);
            $comment_topic      = mysqli_real_escape_string($connect, $_POST['topic']);
            $comment_date       = date('Y-m-d');

            if(!empty($commentbook_id) && !empty($comment_username) && !empty($comment_book) && !empty($comment_topic) && !empty($comment_date))
            {
                $insert_comment = "INSERT INTO comments (username, book_id, topic, comment, datetime) VALUES ('$comment_username', '$commentbook_id', '$comment_topic', '$comment_book', '$comment_date')";

                $insert_result = mysqli_query($connect, $insert_comment);

                if($insert_result)
                {
                    echo '<script> alert("Comment Successfully!"); </script>';
                    echo "<meta http-equiv='refresh' content='0'>";
                }
                else
                {
                    echo 'EROR with inserting comment to table';
                    echo '<br>';
                    echo mysqli_error($connect);
                }
            }
            else
            {
                echo '<span>Please fill out all fields!</span>';
            }
        }
        else
        {
            echo ' No comments';
        }
        ?>

        

    </div>


</body>

<?php include("footer.php"); ?>

<script>

$("#addcart").click(function()
{
    ev.preventDefault();
    $("#gocart").removeClass('hide');
})

function goBack() {
  window.history.back()
}


</script>


</html>