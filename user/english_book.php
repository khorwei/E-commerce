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
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <title>Book List</title>
</head>

<?php include("header.php") ?>


<style>
h1 
{
    font-size: 50px;
    color: black;
    letter-spacing: 8px;
    padding: 15px;
    margin: 20px;
}

.add_book 
{
    text-align:center;
    padding: 10px;
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
    background-color: #f5f5f5;
    border-top: 1px solid #ddd;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
}

.img-responsive
{
    display: block;
    max-width: 100%;
    height: 500px;
}

.book-table td 
{
    padding: 8px;
    font-size: 15px;
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


.detailbtn 
{
    width: 100%;
    text-align: center;
    color: white;
    background-color: #6199ba;
    border: none;
    padding: 10px;
    letter-spacing: 2px;
    border-radius: 2px;
    font-size: 16px;
}

.detailbtn:hover 
{
    color: #2e556b;
    background-color: #adcced;
    font-weight: bold;
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

        <h1>English Book</h1>

    </div>

    <div class="book_container">
        <div class="row">
            <?php

            $show_book = "SELECT * FROM books WHERE category = 'English Books' ORDER BY bookname ";
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

                    if (strlen($bookname) > 30)
                        $bookname = substr($bookname, 0, 27) . '...';

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
                                            <td class="col1"><i class="far fa-user"></i>&nbsp;&nbsp;Author</td>
                                        </tr>

                                        <tr>
                                            <td class="col2"> '.$author.'</td>
                                        </tr>

                                        <tr>
                                            <td class="col1"><i class="fas fa-money-bill-alt"></i>&nbsp;Price </td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="col2">RM '.$price.'</td>
                                        </tr>
                                    </table>

                                </div>

                                <div class="panel-footer">

                                    <form method="POST" action="book_detail.php">
                                        <button type="submit" id="view" class="detailbtn" name="view" value="'.$book_id.'"><i class="fas fa-paper-plane"></i>&nbsp;View Detail</button>
                                    </form>

                                </div>
                            </div>
                        
                    
                        </div>';
                        
                }
                }
            
            
            ?>
        </div>
    </div>
    
</body>

<?php include("footer.php") ?>

<!-- <script>
$(window).load(function()
{
    $(".addcart").click(function()
    {
        $(".popoutbox").show();
    });

    $(".closebtn").click(function()
    {
        $('.popoutbox').hide();
    });

    $(".cancelbtn").click(function()
    {
        $('.popoutbox').hide();
    });

}) -->

</script>
</html>