<?php

include("../include/connection.php");
include("session.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/logo6.png" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Book List</title>
</head>

<?php include("header.php") ?>


<style>

h1 
{
    font-size: 50px;
    color: black;
    text-transform: uppercase;
}

.add_book 
{
    text-align:center;
    padding: 20px;
    letter-spacing: 4px;
}

.add_book a
{
    font-size: 20px;
}

.add_book a:hover
{
    color: red;
    background-color: white;
    font-style: normal;
    font-weight: bold;
}

.book_container 
{
    padding-right:15px;
    padding-left:15px;
    margin-right:auto;
    margin-left:auto;
    border-radius:6px;
    max-width: 100;
}

.book_container
{
    padding-right:60px;
    padding-left:60px;
}

.container:after,
.container:before,
.panel-body:after,
.panel-body:before,
.row:after,
.row:before
{
    display:table;
    content:" ";
}

.container:after,
.panel-body:after,
.row:after
{
    clear:both;
}

@media (min-width:768px)
{
    .book_container
    {
        width:750px;
    }
}

@media (min-width:992px)
{
    .book_container
    {
        width:970px;
    }
}

@media (min-width:1200px)
{
    .book_container
    {
        width:1170px;
    }
}

.row
{
    margin-right:-15px;
    margin-left:-15px;
}

.col-sm-4
{
    position:relative;
    min-height:1px;
    padding-right:15px;
    padding-left:15px;
    height: auto;
}

.panel
{
    margin-bottom:20px;
    background-color:#fff;
    border:1px solid transparent;
    border-radius:4px;
    -webkit-box-shadow:0 1px 1px rgba(0,0,0,.05);
    box-shadow:0 1px 1px rgba(0,0,0,.05);
}

.panel+.panel
{
    margin-top:5px;
}

.panel-primary
{
    border-color:#337ab7;
}

.panel-body
{
    padding:15px;
    border-bottom:1px solid #ddd;
}

.panel-heading
{
    padding:10px 15px;
    border-bottom:1px solid transparent;
    border-top-left-radius:3px;
    border-top-right-radius:3px;
    color:#333;
    background-color:#f5f5f5;
    border-color:#ddd
}


.panel-footer
{
    padding: 10px 15px;
    background-color: white;
    border-top: 1px solid #ddd;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
}

.img-responsive
{
    display: block;
    max-width: 100%;
    height: 550px;
}

.book-table td 
{
    padding: 8px;
}

td.col1 
{
    font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
    color: #288fc9;
    font-weight: bold;
    font-size: 20px;
}

td.col2 
{
    font-size: 18px;
    color: black;
}

.editbook, .removebook
{
    width: 100%;
    text-align: center;
    color: white;
    background-color: #6199ba;
    border: none;
    padding: 10px;
    letter-spacing: 2px;
    border-radius: 4px;
    font-size: 16px;
}

.removebook 
{
    background-color: #fa493c;
}

.editbook:hover, .removebook:hover 
{
    color: #366682;
    background-color: #adcced;
    font-weight: bold;
}

.removebook:hover
{
    color: #f7382a;
    background-color: #faafaa;
    font-weight: bold;
}

button 
{
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

img.transparent 
{
    opacity: 0.4;
}

.centered {
  position: absolute;
  top: 40%;
  left: 50%;
  transform: translate(-50%, -50%);
  letter-spacing: 8px;
  font-size: 50px;
  color: #244b73;
  font-weight: bold;
  text-align: center;
}

</style>

<body>

    

    <div class="add_book">
        <h1>Book List</h1>
    
        <a href="add_book.php" class="add_book"><i class="fas fa-arrow-circle-right"></i>&emsp;Add New Book&emsp;<i class="fas fa-arrow-circle-left"></i></a>
    </div>

    <div class="book_container">
        <div class="row">
            <?php

            $show_book = "SELECT * FROM books";
            $result    = mysqli_query($connect, $show_book);
            $count     = mysqli_num_rows($result);

            if($count == 0)
            {
                echo'Book List is empty.';
            }
            else
            {
                while($row = mysqli_fetch_array($result))
                {
                    $book_id    = $row['book_id'];
                    $bookname   = $row['bookname'];
                    $author     = $row['author'];
                    $price      = $row['price'];
                    $quantity   = $row['quantity'];
                    $detail     = $row['detail'];
                    $image_path = $row['image_path'];
                    $added_date = $row['added_date'];

                    if (strlen($bookname) > 33)
                        $bookname = substr($bookname, 0, 30) . '...';

                    echo'<div class="col-sm-4">
                            <div class="panel panel-primary">
                                
                                <div class="panel panel-heading">
                                '.$bookname.'
                                </div>';

                    if ($quantity > 0 )
                    {          
                        echo'
                        <div class="panel-body">
                            <img src="'.$image_path.'"  class="img-responsive" style="width:100%">';
                    }  
                    else
                    {
                        echo'
                        <div class="panel-body">
                            <img src="'.$image_path.'"  class="img-responsive transparent" style="width:100%">
                            <div class="centered"> OUT OF STOCK</div>';
                    }

                        echo'<table class="book-table">
                                <tr>
                                    <td class="col1"><i class="far fa-user"></i>&nbsp;&nbsp;Author:</td>
                                </tr>

                                <tr>
                                    <td class="col2"> '.$author.'</td>
                                </tr>

                                <tr>
                                    <td class="col1"><i class="fas fa-money-bill-alt"></i>&nbsp;Price: </td>
                                </tr>
                                
                                <tr>
                                    <td class="col2">RM '.$price.'</td>
                                </tr>
                            </table>

                        </div>

                        <div class="panel-footer">
                            <div>
                                <form method="POST" action="edit_book.php">
                                    <button type="submit" id="editbook" name="editbook" class="editbook" value="'.$book_id.'"><i class="fa fa-pencil-square-o"></i>&nbsp;Edit Book</button>
                                </form>
                            </div>
                            <div>
                                <form method="POST" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
                                    <button type="submit" id="removebook" name="removebook" class="removebook" value="'.$book_id.'"><i class="fa fa-remove"></i>&nbsp;Remove Book</button>
                                </form>
                            </div>
                        </div>

                    </div>
                
            
                </div>';
                }
            }

            //echo isset($_POST['removebook']);

            if(isset($_POST['removebook']))
            {
                echo "remove book id: ".$_POST['removebook'];

                $_SESSION['del_bookid'] = $_POST['removebook'];
                $del_bookid = $_SESSION['del_bookid'];

                echo '<br> delete book id:'.$del_bookid;

                $select_sql = "SELECT * FROM books WHERE book_id = $del_bookid";

                $result = mysqli_query($connect, $select_sql);
                $row    = mysqli_fetch_assoc($result);

                $bookname = $row['bookname'];

                echo("bookname ->" .$bookname);

                // $delete_sql = "DELETE FROM books, cart USING books INNER JOIN cart WHERE book_id = $del_bookid";

                $select_cart = "SELECT * FROM cart WHERE book_id = $del_bookid";
                $result1 = mysqli_query($connect, $delete_sql);

                $count_cart = mysqli_num_rows($result1);

                if ($count_cart == 0)
                {
                    $delete_sql = "DELETE FROM books WHERE book_id = $del_bookid";

                    $delete_result = mysqli_query($connect, $delete_sql);

                    if($delete_result)
                    {
                        echo '
                        <script> 
                            alert("'.$bookname.' has been removed.")
                        </script>';
                        echo "<meta http-equiv='refresh' content='0'>";
                    }
                    else
                    {
                        echo('Problem with delete book from table book.');
                    }
                }
                elseif($count_cart > 0 && $delete_result)
                {
                    $delete_sql = "DELETE FROM books, cart USING books INNER JOIN cart WHERE book_id = $del_bookid";

                    $delete_result = mysqli_query($connect, $delete_sql);

                    if($delete_result)
                    {
                        echo '<script> alert("'.$bookname.' has been removed.")
                        </script>';
                        echo "<meta http-equiv='refresh' content='0'>";
                    }
                    else
                    {
                        echo('Problem with delete book from table book and cart');
                    }

                }
                else
                {
                    echo"Problem with checking book in table cart.";
                }
            }
            ?>
        </div>
    </div>
    
</body>

<?php include("footer.php") ?>

<script>

</script>

</html>