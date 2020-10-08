<?php
include("../include/connection.php");
include("session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
</head>

<?php include("header.php"); ?>

<style>

.user_list
{
    text-align: center;
    text-decoration: underline;
}

.user_table 
{
    font-family: "Trebuchet MS", Helvetica, sans-serif;
    letter-spacing: 2px;
    border-collapse: collapse;
    width: 50%;
    margin-left: auto;
    margin-right: auto;
    color: black;
}

.user_table th
{
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #366682;
    color: white;
    height: 50px;
}

.user_table td
{
    width:auto;
}

.user_table tr:nth-child(even)
{
    background-color: #d1e1eb;
}

.user_table td, .user_table th
{
    border: 1px solid #ddd;
    padding: 8px;
}

/* add user */
div.add_user
{
    text-align: center;
    padding: 20px;
    font-size: 16px;
    margin: 0;
    color:#366682;
}

.add
{
    color: #0D98BA;
    font-weight: bold;
}

.add:hover 
{
    background-color: white;
    font-style: none;
    color: red;
}

.editbtn
{
    letter-spacing: 2px;
    background-color: #0D98BA;
    width: 200px;
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

.editbtn:hover
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

</style>

<body>
    <h1 class="user_list">User List</h1>

    <div class="add_user">
        <a href="add_user.php" class="add"><i class="fas fa-arrow-circle-right"></i>&emsp;Add User&emsp;<i class="fas fa-arrow-circle-left"></i></a>
    </div>

    <table class="user_table">
        <tr>
            <th>Username</th>
            <th>Email Address</th>
            <th>Actions</th>
        </tr>

    
    <?php
        
    //show user list
    $select_user = "SELECT username, email, user_id FROM users";
    $result = mysqli_query($connect, $select_user);

    if($result)
    {
        //count the row inside the table
        $total_user = mysqli_num_rows($result);


        if ($total_user == 0)
        {
            echo "<p>The User list is empty.</p>";
        }

        else
        {
            while($row = mysqli_fetch_array($result))
            {
                $username = $row['username'];
                $email    = $row['email'];
                $id       = $row['user_id'];


                echo'
                <tr>
                    <td>'.$username.'</td>
                    <td>'.$email.'</td>
                    <td>
                        <form action="user_profile.php" method="POST">
                            <button class="editbtn" name="userview" value="'.$id.'">View User</button>
                        </form>
                        
                        <form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">
                            <button class="removebtn" name="remove" id="removeBtn" value="'.$id.'">Remove User</button>
                        </form>

                    </td>
                </tr>';
            
            }
            echo '</table>';
        }
    }

    if(isset($_POST['remove']))
    {
        echo $_POST['remove'];

        $_SESSION['user'] = $_POST['remove'];
        $id = $_SESSION['user'];

        
        $select_sql = "SELECT username FROM users WHERE user_id = $id";

        $result = mysqli_query($connect, $select_sql);
        $row = mysqli_fetch_assoc($result);

        $username = $row['username'];

        $delete_sql = "DELETE FROM users WHERE user_id = $id";
        $delete_result = mysqli_query($connect, $delete_sql);

        if($delete_result)
        {
            echo '<script> alert("User '.$username.' is deleted.") </script>';
        }
        
    }
        
    ?>


    <!-- <div id="myModal" class="modal">

        <div class="modal-content">

            <span class="close">&times;</span>
            <p>Are you sure you want to delete <?php echo $username ?> </p>
            
            <form method="POST">
                <button class="btn" name="yes" value="<?php $id ?>">Yes, remove now</button>
            </form>
            
            <button onclick="goBack()">No, I want to go back</button>

        </div>

    </div> -->

    

</body>


<?php include("footer.php"); ?>


</html>