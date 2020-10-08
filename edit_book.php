<?php
include("../include/connection.php");
include("session.php");

$error = "";

if(isset($_POST['editbook']))
{
    $_SESSION['editbook_id'] = $_POST['editbook'];
}


if(isset($_SESSION['editbook_id']))
{
    $book_id = $_SESSION['editbook_id'];

    $select_book = "SELECT * FROM books WHERE book_id = $book_id";
    $book_result = mysqli_query($connect, $select_book);
    $row = mysqli_fetch_assoc($book_result);

    if($book_result)
    {
        $bookname   = $row['bookname'];
        $book_id    = $row['book_id'];
        $author     = $row['author'];
        $price      = $row['price'];
        $category   = $row['category'];
        $image_path = $row['image_path'];
        $stock      = $row['quantity'];
        $detail     = $row['detail'];
    }
    else
    {
        $error = "error with select book from books table";
    }
}
else
{
    $error = "Can't Get book id!";
}
?>

<?php 

// echo "           &emsp;hi";
if(isset($_POST['update']))
{
    // echo $book_id;
    // echo "<br> >>><>>".$_POST['update']."<br>";
    $edit_book_id    = mysqli_real_escape_string($connect, $_POST['update']);
    $edit_bookname   = mysqli_real_escape_string($connect, $_POST['bookname']);
    $edit_author     = mysqli_real_escape_string($connect, $_POST['author']);
    $edit_category   = mysqli_real_escape_string($connect, $_POST['category']);
    $edit_price      = mysqli_real_escape_string($connect, $_POST['price']);
    $edit_stock      = mysqli_real_escape_string($connect, $_POST['stock']);
    $edit_detail     = mysqli_real_escape_string($connect, $_POST['detail']);

    $targetfolder = "../bookimage/";
    $targetfolder = $targetfolder . basename($_FILES['image']['name']);

    $ok = 1;
    $maxsize = 2097152;

    $file_size = $_FILES['image']['size'];
    $file_type = $_FILES['image']['type'];
    
    $filename  = basename($_FILES['image']['name']);

    // echo $edit_bookname;
    // echo $bookname;

    if(empty(trim($edit_bookname)))
    {
        $edit_bookname = $bookname;
    }
    else
    {
        $edit_bookname;
    }

    $update = "UPDATE books SET bookname = '$edit_bookname' WHERE book_id = $edit_book_id";

    $result = mysqli_query($connect, $update);

    if($result)
    {
        echo("<meta http-equiv='refresh' content='1'>");
    }
    else
    {
        echo "<br>error again!!!!!<br>";
        die(mysqli_error($connect));
        echo "<br>error again!!!!!<br>";
    }

    if(empty(trim($edit_author)))
    {
        $edit_author = $author;
    }
    else
    {
        $edit_author;
    }

    $update = "UPDATE books SET author = '$edit_author' WHERE book_id = $edit_book_id";

    $result = mysqli_query($connect, $update);

    if($result)
    {
        echo("<meta http-equiv='refresh' content='1'>");
    }
    else
    {
        echo "<br>error again!!!!!<br>";
        die(mysqli_error($connect));
        echo "<br>error again!!!!!<br>";
    }

    if(empty(trim($edit_price)))
    {
        $edit_price = $price;
    }
    else
    {
        $edit_price;
    }

    $update = "UPDATE books SET price = '$edit_price' WHERE book_id = $edit_book_id";

    $result = mysqli_query($connect, $update);

    if($result)
    {
        echo("<meta http-equiv='refresh' content='1'>");
    }
    else
    {
        echo "<br>error again!!!!!<br>";
        die(mysqli_error($connect));
        echo "<br>error again!!!!!<br>";
    }

    if(empty(trim($edit_category)))
    {
        $edit_category = $category;
    }
    else
    {
        $edit_category;
    }

    $update = "UPDATE books SET category = '$edit_category' WHERE book_id = $edit_book_id";

    $result = mysqli_query($connect, $update);

    if($result)
    {
        echo("<meta http-equiv='refresh' content='1'>");
    }
    else
    {
        echo "<br>error again!!!!!<br>";
        die(mysqli_error($connect));
        echo "<br>error again!!!!!<br>";
    }

    if(empty(trim($edit_stock)))
    {
        $edit_stock = $stock;
    }
    else
    {
        $edit_stock;
    }

    $update = "UPDATE books SET quantity = '$edit_stock' WHERE book_id = $edit_book_id";

    $result = mysqli_query($connect, $update);

    if($result)
    {
        echo("<meta http-equiv='refresh' content='1'>");
    }
    else
    {
        echo "<br>error again!!!!!<br>";
        die(mysqli_error($connect));
        echo "<br>error again!!!!!<br>";
    }

    if(empty(trim($detail)))
    {
        $edit_detail = $detail;
    }
    else
    {
        $edit_detail;
    }
    

    $update = "UPDATE books SET detail = '$edit_detail' WHERE book_id = $edit_book_id";

    $result = mysqli_query($connect, $update);

    if($result)
    {
        echo("<meta http-equiv='refresh' content='1'>");
    }
    else
    {
        echo "<br>error again!!!!!<br>";
        die(mysqli_error($connect));
        echo "<br>error again!!!!!<br>";
    }

    if(empty($_FILES) && empty(($_FILES['image']['tmp_name'])))
    {
        //remain same so no update
        $targetfolder = $image_path;
        // echo empty($_FILES['image']['tmp_name']);
        // echo "<br> imagr";
        echo("<meta http-equiv='refresh' content='1'>");
    }
    else
    {
        
        echo empty($_FILES['image']['tmp_name']);
        echo "<br>";
        $targetfolder = "../bookimage/";
        $targetfolder = $targetfolder . basename($_FILES['image']['name']);
        $file_size = $_FILES['image']['size'];
        $file_type = $_FILES['image']['type'];
    
        $filename  = basename($_FILES['image']['name']);

        if($file_size <= $maxsize)
        {
            if($file_type != '')
            {
                if($file_type == "image/jpeg" || "image/png" || "image/gif" || "image/jpg")
                {
                    if(move_uploaded_file($_FILES['image']['tmp_name'], $targetfolder))
                    {
                        $update_book = "UPDATE books SET image_path = '$targetfolder' WHERE book_id = $edit_book_id";

                        // echo "<br>insert -> ".$update_book;
                        // echo "<br>";

                        $result = mysqli_query($connect, $update_book);

                        if($result)
                        {
                            // echo 'update image successful!';
                            echo '<script> alert('.$edit_bookname.' has been updated!") </script>';
                            echo("<meta http-equiv='refresh' content='1'>");

                        }
                        else
                        {
                            echo "<br>";
                            die(mysqli_error($connect));
                            echo 'cant refresf the page!! ';
                            echo 'or insert table??';
                        }
                    }
                    else
                    {
                        echo 'Problem with upload image.';
                    }
                }//if it is not a image
                else
                {
                    echo '
                    <script>
                        alert("You may only upload PNG, JPEG/JPG, GIF.");
                    </sccript>
                    ';
                }
            }//if user didnt upload and file
            else
            {
                echo '
                <script>
                    alert("Please select an image to upload.");
                </sccript>
                ';
            }
        }
        else
        {
            echo '
            <script>
                alert("The size is too large. Image must be less than 2 MB(Megabytes.)");
            </script>
            ';
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
    <title><?php echo $bookname?> --- Edit</title>
</head>

<?php include("header.php") ?>

<style>
.cancelbtn
{
    width: 100%;
    text-align: center;
}

.submitbtn 
{
    letter-spacing: 2px;
}

.button 
{
    width: 80%;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
}

.book_detail
{
    text-align: center;
    text-decoration: underline;
    font-size: 50px;
    color: black;
    text-transform: uppercase;
}

.bookdetail_table 
{
    font-family: "Trebuchet MS", Helvetica, sans-serif;
    letter-spacing: 2px;
    border-collapse: collapse;
    width: 80%;
    margin-left: auto;
    margin-right: auto;
    color: black;
}

.bookdetail_table th
{
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #366682;
    color: white;
    height: 50px;
}

.bookdetail_table td
{
    width: auto;
    min-height: 500px; 
}

.bookdetail_table td, 
.bookdetail_table th
{
    /* border: 1px solid #ddd; */
    padding: 8px;
}

td.col1 
{
    font-weight: bold;
    text-transform : uppercase;
    padding-left: 20px;
    text-align: center;
    background-color: #d1e1eb;
}

input[type=number],
input[type=text],
input[type=file]
{
    padding: 20px;
    border-radius: 8px;
}

.container 
{
    font-size: 20px;
}

.err-msg
{
    color: red;
}

div.filled 
{
    text-align: center;
    color: black;
    padding: 20px;
}
</style>

<body>

    <h1 class="book_detail">Edit Book: <?php echo $bookname;?></h1>
    <span class="err-msg"><?php echo $error; ?></span>

    <div class="container">
    <form action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">

        <div class="imgcontainer">
            <img src="<?php echo $image_path;?>" alt="Add Book" class="avatar">
        </div>    

        <div class="filled">
            <span>Please make sure all fields are <span style="color:red;">FILLED!</span></span>
            <br>
            <span>If the field is <span style="color:red;">empty</span>, it will <span style="color:red;">remain the same.</span></span>
            <br>
        </div>

        <table class="bookdetail_table">
            <tr>
                <td class="col1"> BookName </td>
                <td><input type="text" name="bookname" placeholder="<?php echo $bookname;?>" value="<?php echo $bookname; ?>"></td>
            </tr>

            <tr>
                <td class="col1"> Author </td>
                <td><input type="text" name="author" placeholder="<?php  echo $author;?>" value="<?php echo $author ?>"></td>
            </tr>

            <tr>
                <td class="col1"> Category </td>
                <td><input type="text" name="category" placeholder="<?php  echo $category;?>" value="<?php echo $category ?>"></td>
            </tr>

            <tr>
                <td class="col1"> Price </td>
                <td><input type="number"  min="1.00" step="0.01" name="price" placeholder="<?php  echo $price;?>" value="<?php echo $price ?>"></td>
            </tr>

            <tr>
                <td class="col1"> Stock </td>
                <td><input type="number"  min="0" step="1" name="stock" placeholder="<?php  echo $stock;?>" value="<?php echo $stock ?>"></td>
            </tr>

            <tr>
                <td class="col1"> Description </td>
                <td><textarea type="text" name="detail" rows='4' cols='75' placeholder="<?php  echo $detail;?>" value="<?php  echo $detail;?>"><?php  echo $detail;?></textarea></td>
            </tr>

            <tr>
                <td class="col1"> Image </td>
                <td><input type="file" name="image" id="image"></td>
            </tr>
        </table>

        <!-- Button -->
        <div class="button">
            <br>
            <button type="submit" class="submitbtn" name="update" id="submit" value="<?php echo $book_id ?>"><i class="fas fa-cloud-upload-alt"></i>&emsp;Update</button>

            <br>
            <button type="reset" class="cancelbtn" name="cancel"><i class="fas fa-chevron-left"></i>&emsp;Cancel</button>
        </div>

    </form>

    </div>



</body>

<?php include('footer.php') ?>

</html>

<script>
$(document).ready(function()
{
    $('#submit').click(function()
    {
        //$(selector).val() => return the value attribute
        var image_name = $('#image').val();
        if(image_name == '')
        {
            alert("Please select image");
            return false;
        }
        else{
            car extension = $('#image').val().split('.').pop().toLowerCase();
            if(jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1)
            {
                alert('Invalid Image File!');
                $('#image').val('');
                return false;
            }
        }
    })
});

</script>