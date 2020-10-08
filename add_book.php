<?php

//set the timezone to store the current time for book
date_default_timezone_set("Asia/Singapore");

//include some necessary files
include('../include/connection.php');
include('session.php');
include('header.php');


//make sure user is logged in
if((!empty($_SESSION['login_user'])) && (!isset($_SESSION['login_user'])))
{
    header('Location: login.php');
}

/*----------------ADD BOOK------------------*/

//Define variables and initialize with empty values
$bookname = $author = $price = $category = $quantity = $detail = $images ='';

//Define empty error message
$bookname_err   = "";
$author_err     = "";
$category_err   = "";
$price_err      = "";
$images_err     = ""; 
$detail_err     = "";
$quantity_err   = "";

//testing
if($_SERVER['REQUEST_METHOD'] == "POST")
{
if(isset($_POST["submit"]))
{
    $bookname = mysqli_real_escape_string($connect, $_POST['bookname']);
    $author   = mysqli_real_escape_string($connect, $_POST['author']);
    $price    = mysqli_real_escape_string($connect, $_POST['price']);
    $category = mysqli_real_escape_string($connect, $_POST['category']);
    $quantity = mysqli_real_escape_string($connect, $_POST['quantity']);
    $detail   = mysqli_real_escape_string($connect, $_POST['detail']);
    $datetime = date('Y-m-d');

    $targetfolder = "../bookimage/";
    $targetfolder = $targetfolder . basename($_FILES['image']['name']);

    $ok = 1;
    $maxsize = 2097152;

    $file_size = $_FILES['image']['size'];
    $file_type = $_FILES['image']['type'];
    
    $filename  = basename($_FILES['image']['name']);

    if(empty(trim($bookname)))
    {
        $bookname_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Bookname is <strong>REQUIRED</strong>!';
    }
    
    if(empty(trim($author)))
    {
        $author_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Author name is <strong>REQUIRED</strong>!';
    }
    /*else
    {
        echo 'author is'.$author;
    }*/

    if(empty(trim($price)))
    {
        $price_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Price is <strong>REQUIRED</strong>!';
    }
    /*else
    {
        echo 'price is'.$price;
    }*/

    if(empty(trim($category)))
    {
        $category_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Category is <strong>REQUIRED</strong>!';
    }
    /*else
    {
        echo 'Category is'.$category;
    }*/

    if(empty(trim($quantity)))
    {
        $quantity_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Quantity of book is <strong>REQUIRED</strong>!';
    }
    /*else
    {
        echo 'quanity is'.$quantity;
    }*/

    if(empty(trim($detail)))
    {
        $detail_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Details is <strong>REQUIRED</strong>!';
    }
    

    if(empty(trim($datetime)))
    {
        echo 'cant record time date';
    }

    if(empty(($_FILES['image']['tmp_name'])))
    {
        $images_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Image is <strong>REQUIRED</strong>!';
    }

    if(empty($bookname_err) && empty($author_err) && empty($price_err) && empty($category_err) && empty($quantity_err) && empty($detail_err) && !empty($datetime) && empty($images_err))
    {
    
        if(empty(($_FILES['image']['tmp_name'])))
        {
            $images_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Image is <strong>REQUIRED</strong>!';
        }
        else
        {
            if($file_size <= $maxsize)
            {
                if($file_type != '')
                {
                    if($file_type == "image/jpeg" || "image/png" || "image/gif" || "image/jpg")
                    {
                        // echo $targetfolder;
                        if(move_uploaded_file($_FILES['image']['tmp_name'], $targetfolder))
                        {
                            $insert_book = "INSERT INTO books (bookname, author, price, category, quantity, detail, image_path, added_date) VALUES ('$bookname','$author','$price','$category','$quantity','$detail', '$targetfolder', '$datetime')";

                            $book_result = mysqli_query($connect, $insert_book);

                            if($book_result)
                            {
                             echo '
                            <script>
                                alert("Book '.$bookname.' has been added succesfully!");
                            </script>
                            ';   
                            }
                            else
                            {
                                echo 'Problem with insert book into database.';
                            }

                        }
                        else
                        {
                            echo 'Problem uploading image';
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
                }//if user didn't upload any file
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
}
}

  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book Form</title>
    <link rel="stylesheet" href="../css/form.css">
    <link rel="icon" href="../images/logo6.png" type="image/gif" sizes="16x16">
</head>

<style>

.submitbtn 
{
    letter-spacing: 2px;
}

.err-msg
{
    color: red;
}

h1
{
    text-align : center;
}

.cancelbtn
{
    width: 100%;
}

textarea 
{
    width: 100%;
    resize: none;
}

form 
{
    font-size: 16px;
}

</style>

<body>

    <h1>Add Book Form</h1>  
    <p>Please fill in this form to add new book!</p>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data" class="form-container">
    
    <div class="imgcontainer">
        <img src="../images/addbook.png" alt="Add Book" class="avatar">
    </div>

    <div class="container">


        
        <br>
        <p style="color: red;">*Required</p>

        <hr>

        <!-- Bookname -->
        <div> 


            <label for="bookname">
            Bookname *
            </label>

            <input type="text" name="bookname" placeholder="Enter Bookname" value="<?php echo $bookname;?>">
            <span class="err-msg"><?php echo $bookname_err;?></span>

        </div>

        <!-- Author -->
        <div>

            <label for="author">
            Author Name *
            </label>

            <input type="text" name="author" placeholder="First Last">
            <span class="err-msg"><?php echo $author_err?></span>
            
        </div>

        <!-- Category -->
        <div>

            <label for="category">
            Category *
            </label>

            <select id="category" name="category">
                <option value="Chinese Books">Chinese Book</option>
                <option value="English Books">English Book</option>
                <option value="Others">Others</option>
            </select>
            <span class="err-msg"><?php echo $category_err?></span>
            
        </div>

        <!-- Price -->
        <div>

            <label for="price">
            Price *
            </label>

            <input type="number" min="1.00" step="0.01" name="price" placeholder="35.00" title="35.00">
            <span class="err-msg"><?php echo $price_err?></span>
        
        </div>

        <!-- Quantity -->
        <div>

            <label for="quantity">
            Quantity *
            </label>

            <input type="number" min="1" step="1" name="quantity" placeholder="1">
            <span class="err-msg"><?php echo $quantity_err?></span>
        
        </div>

        <!-- Details -->
        <div>

            <label for="detail">
            Description *
            </label>
            <textarea name='detail' rows='4' cols='50' placeholder='Provide some description of the book. Eg: The situatuion of this book? How long has been bought since the date you buy?'></textarea>
            <span class="err-msg"><?php echo $detail_err?></span>
        
        </div>

        <!-- Images -->
        <div>
        
            <label for="images" class="images">
            Choose an Image *
            </label>
            <span class="err-msg"><?php echo $images_err?></span>

            <br>
            <input type="file" name="image" id="image" class="inputfile"/>

        </div>

        <!-- Button -->
        <div>
            <br>
            <button type="submit" class="submitbtn" name="submit" id="submit"><i class="fas fa-cloud-upload-alt"></i>&emsp;Upload</button>
            <button type="reset" class="cancelbtn" name="cancel"><i class="fas fa-chevron-left"></i>&emsp;Cancel</button>
        </div>
    </div>
    </form>
    
</body>

<?php include("footer.php") ?>

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