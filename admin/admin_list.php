<?php
include("../include/connection.php");
include("session.php");

// if(isset($_POST['remove']))
// {
//     $_SESSION['admin'] = $_POST['remove'];
//     $id = $_SESSION['admin'];
//     //echo $id;

//     $select_sql = "SELECT * FROM admins WHERE admin_id = $id";

//     $username = $row['username'];

//     if(isset($_POST['yes']))
//     {
//         echo $id;
//     }

// }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/logo6.png" type="image/gif" sizes="16x16">
    <title>Admin List</title>
</head>

<?php include("header.php"); ?>

<style>

.admin_list
{
    text-align: center;
    text-decoration: underline;
}

.admin_table 
{
    font-family: "Trebuchet MS", Helvetica, sans-serif;
    letter-spacing: 2px;
    border-collapse: collapse;
    width: 50%;
    margin-left: auto;
    margin-right: auto;
    color: black;
}

.admin_table th
{
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #366682;
    color: white;
    height: 50px;
}

.admin_table td
{
    width:auto;
}

.admin_table tr:nth-child(even)
{
    background-color: #d1e1eb;
}

.admin_table td, .admin_table th
{
    border: 1px solid #ddd;
    padding: 8px;
    font-size: 20px;
    text-align: center;
    letter-spacing: 4px;
}

/* add admin */
div.add_admin
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
    font-size: 14px;
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
    font-size: 14px;
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

form 
{
    text-align: center;
}

</style>

<body>
    <h1 class="admin_list">Admin List</h1>

    <div class="add_admin">
        <a href="add_admin.php" class="add"><i class="fas fa-arrow-circle-right"></i>&emsp;Add Admin&emsp;<i class="fas fa-arrow-circle-left"></i></a>
    </div>

    <table class="admin_table">
        <tr>
            <th>Username</th>
            <th>Email Address</th>
            <th width=250px;>Actions</th>
        </tr>

    
    <?php
        
    //show admin list
    $select_admin = "SELECT username, email, admin_id FROM admins";
    $result = mysqli_query($connect, $select_admin);

    if($result)
    {
        //count the row inside the table
        $total_admin = mysqli_num_rows($result);


        if ($total_admin == 0)
        {
            echo "<p>The Admin list is empty.</p>";
        }

        else
        {
            while($row = mysqli_fetch_array($result))
            {
                $username = $row['username'];
                $email = $row['email'];
                $id = $row['admin_id'];

                if($_SESSION['login_admin'] == $username)
                {
                    echo '
                    <tr>
                        <td>'.$username.'</td>
                        <td>'.$email.'</td>
                        <td>
                            <form action="edit_profile.php" method="POST">
                                <button class="editbtn" name="edit" value="'.$id.'" >Edit Profile</button>
                            </form>
                        </td>
                    </tr>';
                }

                else
                {
                    echo'
                    <tr>
                        <td>'.$username.'</td>
                        <td>'.$email.'</td>
                        <td>
                            <form action="edit_profile.php" method="POST">
                                <button class="editbtn" name="edit" value="'.$id.'" >Edit Profile</button>
                            </form>
                            
                            <form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">
                                <button class="removebtn" name="remove" id="removeBtn" value="'.$id.'">Remove Admin</button>
                            </form>

                        </td>
                    </tr>';
                }
            }
            echo '</table>';
        }
    }

    if(isset($_POST['remove']))
    {
        //echo $_POST['remove'];

        $_SESSION['admin'] = $_POST['remove'];
        $id = $_SESSION['admin'];

        
        $select_sql = "SELECT username FROM admins WHERE admin_id = $id";

        $result = mysqli_query($connect, $select_sql);
        $row = mysqli_fetch_assoc($result);

        $username = $row['username'];

        $delete_sql = "DELETE FROM admins WHERE admin_id = $id";
        $delete_result = mysqli_query($connect, $delete_sql);

        if($delete_result)
        {
            echo '<script> alert("Admin '.$username.' is deleted.") </script>';
            echo "<meta http-equiv='refresh' content='0'>";
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