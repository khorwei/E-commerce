<?php
include("../include/connection.php");
include("session.php");

date_default_timezone_set("Asia/Singapore");

if(!isset($_SESSION['login_user']))
{
    header('Location: login.php');
}



// 

if(isset($_POST['paynow']))
{
  $fullname     = mysqli_real_escape_string($connect, $_POST['fullname']);
  $phone        = mysqli_real_escape_string($connect, $_POST['phone']);
  $email        = mysqli_real_escape_string($connect, $_POST['email']);
  $address      = mysqli_real_escape_string($connect, $_POST['address']);
  $city         = mysqli_real_escape_String($connect, $_POST['city']);
  $postcode     = mysqli_real_escape_string($connect, $_POST['postcode']);
  $state        = mysqli_real_escape_string($connect, $_POST['state']);
  $cardname     = mysqli_real_escape_string($connect, $_POST['cardname']);
  $cardnum      = mysqli_real_escape_string($connect, $_POST['cardnum']);
  $expmonth     = mysqli_real_escape_string($connect, $_POST['expmonth']);
  $expyear      = mysqli_real_escape_string($connect, $_POST['expyear']);
  $cvv          = mysqli_real_escape_string($connect, $_POST['cvv']); 
  $total_qty    = $cart_count;
  $total_amount = $total;
  $status       = "pending";
  $orderdate    = date('Y-m-d');
  $ordernum     = random_ordernum(10);


  //cehck for duplicate order num;
  // $duplciate = "SELECT ordernum FROM orders";
  // $dup_result = mysqli_query($connect, $duplicate);
  // $count_order = mysqli_num_rows($dup_result);
  // $dup_array = [];

  // if($dup_result && $count_order > 0)
  // {
  //   while ($row_ordernum = mysqli_fetch_array($dup_result))
  //   {
  //     $ordernum_dup = $row_ordernum['ordernum'];
  //     array_push($dup_array, $ordernum);

  //   }

  //     $ordernum = check_duplicate($dup_array, $ordernum);
  // }
  // else
  // {

  // }

  //echo "ID ->".$_POST['paynow'];
  //echo "<br>".$orderdate;
  
  //Validate fullname
  if(empty(trim($fullname))) 
  {
      $fullname_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please enter your fullname.';
  }

  //Validate phone
  if(empty(trim($phone))) 
  {
      $phone_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please enter your phone number';
  }

  //Validate email
  if(empty(trim($email))) 
  {
      $email_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please enter your email address';
  }

  //Validate address
  if(empty(trim($address))) 
  {
      $address_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please enter your address. (Eg. Block Unit/House No)';
  }

  //Validate city
  if(empty(trim($city))) 
  {
      $city_err = "Please enter a city name. (Eg. Bandar Sunway)";
  }

  //Validate postcode
  if(empty(trim($postcode))) 
  {
      $postcode_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please enter postcode. (Eg. 58000)';
  }
  
  //Validate state
  if(empty(trim($state))) 
  {
      $state_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please select a state (Eg. Selangor)';
  }

  //Validate state
  if(empty(trim($cardname))) 
  {
      $cardname_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please enter your card name.';
  }

  //Validate state
  if(empty(trim($cardnum))) 
  {
      $cardnum_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please enter your card number.';
  }

  //Validate state
  if(empty(trim($expmonth))) 
  {
      $expmonth_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please enter expired month of your card.';
  }

  //Validate state
  if(empty(trim($expyear))) 
  {
      $expyear_err = '<i class="fas fa-exclamation-circle"></i>&nbsp;Please enter expired year of your card.';
  }

  //Validate state
  if(empty(trim($cvv))) 
  {
      $cvv_err = "<i class='fas fa-exclamation-circle'></i>&nbsp;Please enter your card's cvv number.";
  }

  if($_SESSION['user_id'] == $_POST['paynow'])
  {
    $order_userid = $_POST['paynow'];
    $select_cart = "SELECT * FROM cart WHERE user_id = $order_userid";
    $result1 = mysqli_query($connect, $select_cart);

    if($result1)
    {
      $total_qty = 0;
      $total_amount = 0;

      while($temp_row = mysqli_fetch_array($result1))
      {
        $price_books = $temp_row['total_amount'];
        $temp_bookid = $temp_row['book_id'];
        $temp_qty    = $temp_row['quantity'];//quantity for each type of book
        $total_qty    = $total_qty + $temp_qty;// total how many book user buy
        $total_amount = $total_amount + $price_books; //total amount for all books

        $select_book = "SELECT * FROM books WHERE book_id = $temp_bookid";
        $book_result = mysqli_query($connect, $select_book);
        
        if($book_result)
        {
          $row1 = mysqli_fetch_assoc($book_result);
          $book_stock = $row1['quantity'];
          $book_stock = $book_stock - $temp_qty;

          $update1 = "UPDATE books SET quantity = $book_stock WHERE book_id = $temp_bookid";
          $updateresult1 = mysqli_query($connect, $update1);

          if(!$updateresult1)
          {
            echo"why so many errore :(((( Update stock fail";
          }
          else
          {
            echo "oh yeah can sleep liao!";
          }

        }
        else
        {
          echo 'Error with select bookkkkk';
        }
      }
    }
    else
    {
      echo 'select cart error';
    }
  }
  else
  {
    echo 'User id not same!';
  }


  $order_sql = "INSERT INTO orders (user_id, order_qty, total_amount, orderdate, status, ordernum) VALUES ('$order_userid', '$total_qty', '$total_amount', '$orderdate', '$status', '$ordernum')";

  echo $order_userid.' before insert. <br>';
  echo '<br>'.$order_sql;

  $order_result = mysqli_query($connect, $order_sql);

  $select_order = "SELECT order_id FROM orders WHERE user_id = $order_userid AND ordernum = $ordernum";
  //echo '<br>'.$select_order;

  $result = mysqli_query($connect, $select_order);

  if($order_result && $result)
  {
    //echo"<br>suceess insert order table!!!<br>";
    $row2 = mysqli_fetch_assoc($result);
    $order_id = $row2['order_id'];

    $order_userid = $_POST['paynow'];
    $select_cart = "SELECT * FROM cart WHERE user_id = $order_userid";
    $result1 = mysqli_query($connect, $select_cart);

    while($user_cart = mysqli_fetch_array($result1))
    {
      //echo"<br>taking bookid from cart and inset into cart order table";
      $cart_bookid = $user_cart['book_id'];
      $book_qty    = $user_cart['quantity'];
      //echo '<br>cart book id -> '.$cart_bookid;
      //echo '<br>'.$cart_bookid.' qty ->'.$book_qty;

      $insert_cartorder = "INSERT INTO cart_order (order_id, book_id, book_qty) VALUES ('$order_id','$cart_bookid','$book_qty')";

      echo "<br>".$insert_cartorder;

      $insert_result = mysqli_query($connect, $insert_cartorder);

      if($insert_result)
      {
        //echo "<br>OMG Insert into order cart successfully! XD<br>";
      }
      else
      {
        echo mysqli_error($connect);
        echo "<br>error happend when inserting data into cart_order :/";
      }

    }

    $deletecart = "DELETE FROM cart WHERE user_id = $order_userid";
    $result2    = mysqli_query($connect, $deletecart);

    if($result2)
    {
      echo'
      <script>
        alert("Payment Successful!");
      </script>
      ';
    }
    else 
    {
      echo mysqli_error($connect);
      //echo "Congrats, still cant sleep! fix error bah. ://";
    }
    
  }
  else
  {
    echo 'Error with insertting data :(';
  }


}

function random_ordernum($length)
{
  $num = "";

  for($i = 0; $i < $length; $i++)
  {
    $num .= rand(0,9);
  }

  return $num;
}

function check_duplicate($array, $ordernum) 
{
  $ordernumber = '';

  for($i = 0; $i < count($array); $i++)
  {
    if($ordernum == $array[$i])
    {
      $ordernumber = random_ordernum(10);
      return $ordernumber;
    }
  }
  return $ordernum;
}


// echo $_SESSION['login_user'];
// echo $_SESSION['user_id'];

//empty error message
$cardname_err = $cvv_err = $cardnum_err = $email_err = $phone_err = $fullname_err = $address_err = $city_err = $postcode_err = $state_err = $expmonth_err = $expyear_err = "";

$cardname = $cvv = $cardnum = $email = $phone = $fullname = $address = $city = $postcode = $state_err = $expmonth = $expyear = "";

$error    = "";
$cart_no  = 0;
$total    = 0;
$product_list = "";
$fullname = $phone = $email= $address = $city = $postcode = $state = $country = $username = $cart_count ="";

// echo "true ->1 ?? ".isset($_POST['checkout']);

if(isset($_POST['checkout']))
{
  if($_POST['checkout'] == $_SESSION['user_id'])
  {
    $user_id = $_POST['checkout'];
    // echo $_POST['checkout'];

    $user_sql     = "SELECT * FROM users WHERE user_id = $user_id";
    $user_result  = mysqli_query($connect, $user_sql);

    $cart_sql     = "SELECT * FROM cart WHERE user_id = $user_id";
    $cart_result  = mysqli_query($connect, $cart_sql);
    $cart_count   = mysqli_num_rows($cart_result);

    // echo "cart num: ".$cart_count;
    // echo "sql cart: ".$cart_sql;


    if($cart_count == 0)
    {
      echo 'Shopping Cart is empty! cant checkout!';
    }
    else
    {
    //  /cho '<br> <b>'.$username.'</b> <- my username. <br>';

      if($user_result && $cart_result)
      {
        $user_row   = mysqli_fetch_assoc($user_result);
        
        $fullname = $user_row['fullname'];
        $phone    = $user_row['phone'];
        $email    = $user_row['email'];
        $address  = $user_row['address'];
        $city     = $user_row['city'];
        $postcode = $user_row['postcode'];
        $state    = $user_row['state'];
        $country  = $user_row['country'];
        $username = $user_row['username'];

        //echo '<br>'.$state.'<state <br> country>'.$country.'<br> phone>'.$phone;

        
        while ($cart_row = mysqli_fetch_array($cart_result))
        {
          $book_id      = $cart_row['book_id'];
          $cartuser     = $cart_row['user_id'];
          $quantity     = $cart_row['quantity'];
          $book_amount  = $cart_row['total_amount'];
          $cart_no      = $cart_no + 1;

          $book_sql     = "SELECT * FROM books WHERE book_id = $book_id";
          $result_book  = mysqli_query($connect, $book_sql);

          if($result_book)
          {
            $book_row   = mysqli_fetch_assoc($result_book);

            $bookname   = $book_row['bookname'];
            $price      = $book_row['price'];
            $image_path = $book_row['image_path'];
            $total      = $total + $book_amount;

            if (strlen($bookname) > 15)
                    $bookname = substr($bookname, 0, 12) . '...';
          

            $product_list .= '<p> Qty: '.$quantity.'<span> &nbsp;'.$bookname.' </span> <span class="price">RM '.$book_amount.'</span></p>';

          }
          else
          {
            $error = "Problem with select book information from table book.";
          }
        }//end of while

      }//end of if (checking cart and user result)
      else
      {
        $error = "Error with select data from users table and cart table. :/";
      }
    }//end of else (if shopping cart has more than one row)
  }//end of if(checking user id usin session and post['checkour'])
  else
  {
    $error = "User id from cart and login are not the same :-<";
  }

}//end of if stament for checking POST['checkout'] is no empty




  

    
    
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../images/logo6.png" type="image/gif" sizes="16x16">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>

<title>Checkout Page</title>
<style>

body 
{
  font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
  letter-spacing: 2px;
}

* 
{
  box-sizing: border-box;
}

.row 
{
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 
{
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 
{
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 
{
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 
{
  padding: 0 16px;
}

.container 
{
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text], 
input[type=email], 
input[type=tel], 
input[type=number], 
select, 
option
{
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
  font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
  font-size: 14px;
  letter-spacing: 2px;
}

label 
{
  margin-bottom: 10px;
  display: block;
  font-weight: bold;
  font-size: 16px;
}

.icon-container 
{
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn, .backbtn
{
  color: white;
  background-color: #ff9500;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover 
{
  background-color: #f2af83;
  color: #db6e00;
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

a 
{
  color: #2196F3;
}

hr 
{
  border: 1px solid lightgrey;
}

span.price 
{
  float: right;
  color: grey;
  text-align: left;
}

.social:hover {
    background-color: #568686;
    text-decoration: underline;
    color: black;
    font-style: italic;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) 
{
    .row 
    {
      flex-direction: column-reverse;
    }
    .col-25 
    {
      margin-bottom: 20px;
    }
}

div.img
{
  text-align: center;
  padding-top: 20px;
}

p.country 
{
  border:1px solid #d7d6d6;
  padding: 10px;
  width: auto;
  margin-bottom: 10px;
  color: black;
  background-color: white;
}
</style>
</head>

<body>
<div class="img"> 
  <img src="../images/logo7.png" alt="" style="width: 350px; height: 150px;">
  <br>
</div>
<br><h2>Checkout Process</h2>

<p>Please ensure your information is correct before click on payment.</p>


<div class="row">
    <div class="col-75">

        <div class="container">
            <form action="done_checkout.php" method="POST">
            
              <div class="row">
                <div class="col-50">

                  <h3>Delivery Address</h3>
                  <label for="fullname">
                  <i class="fa fa-user"></i> Full Name
                  </label>
                  <input type="text" id="fullname" name="fullname" placeholder="<?php echo $fullname;?>" value="<?php echo $fullname;?> "required>
                  <span class="err-msg"><?php echo $fullname_err ?></span>
                  

                  <label for="email"><i class="fa fa-envelope"></i> Email</label>
                  <input type="email" id="email" name="email" placeholder="<?php echo $email; ?>" value="<?php echo $email; ?>" required>
                  <span class="err-msg"><?php echo $email_err ?></span>

                  <label for="phone"><i class="fas fa-phone-square"></i> Phone number</label>
                  <input type="tel" id="phone" name="phone" placeholder="<?php echo $phone; ?>" value="<?php echo $phone; ?>" required>
                  <span class="err-msg"><?php echo $phone_err ?></span>

                  <label for="adress"><i class="fas fa-address-card"></i> Address</label>
                  <input type="text" id="adress" name="address" placeholder="<?php echo $address;?>" value="<?php echo $address;?>" required>
                  <span class="err-msg"><?php echo $address_err ?></span>

                  <label for="city"><i class="fa fa-institution"></i> City</label>
                  <input type="text" id="city" name="city" placeholder="<?php echo $city;?>" value="<?php echo $city;?>" required>
                  <span class="err-msg"><?php echo $city_err ?></span>

                  <div class="row">

                    <div class="col-50">
                      <label for="state"><i class="fas fa-map-marked-alt"></i> State</label>
                      <input type="text" id="state" name="state" placeholder="<?php echo $state;?>" value="<?php echo $state;?> "required>
                      <span class="err-msg"><?php echo $state_err ?></span>
                    </div>

                    <div class="col-50">
                      <label for="postcode"><i class="fas fa-map-signs"></i> Postcode</label>
                      <input type="text" id="postcode" name="postcode" placeholder="<?php echo $postcode;?>" pattern="[0-9]{5}" title="Eg. 58000" value="<?php echo $postcode; ?>" required>
                      <span class="err-msg"><?php echo $postcode_err ?></span>

                    </div>


                  </div>

                    <label for="country"><i class="fa fa-institution"></i>  Country <span style="color:red;">(We only provide Malaysia)</span></label>
                    <p class="country"> Malaysia </p>

                </div>

                <div class="col-50">
                  <h3><i class="fas fa-money-bill-alt" style="color:green;"></i>&nbsp;Payment</h3>

                  <label for="fname">Acceptance Card</label>
                  
                  <div class="icon-container">
                    
                    <i class="fas fa-credit-card" style="color:blue;"></i>
                    
                    <i class="fab fa-cc-mastercard" style="color:red;"></i>

                  </div>

                  <label for="cname">Name on Card</label>
                  <input type="text" id="cname" name="cardname" placeholder="John More Doe" required>
                  <span class="err-msg"><?php echo $cardname_err ?></span>
                  
                  <label for="ccnum">Credit card number</label>
                  <input type="text" id="ccnum" name="cardnum" placeholder="1111222233334444" pattern="[0-9]{16}" required>
                  <span class="err-msg"><?php echo $cardnum_err ?></span>
                 
                  <label for="expmonth">Exp Month</label>
                  <input type="text" id="expmonth" name="expmonth" placeholder="September" required>
                  <span class="err-msg"><?php echo $expmonth_err?></span>

                  <div class="row">
                    <div class="col-50">
                      <label for="number">Exp Year</label>
                      <input type="number" id="expyear" name="expyear" placeholder="2018" required>
                      <span class="err-msg"><?php echo $expyear_err?></span>
                    </div>
                    <div class="col-50">
                      <label for="cvv">CVV</label>
                      <input type="number" id="cvv" name="cvv" placeholder="352" required>
                      <span class="err-msg"><?php echo $cvv_err ?></span>
                    </div>
                  </div>
                </div>
                
              </div>

              <label>
                <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
              </label>
              
                <button type="submit" value="<?php echo $user_id; ?>" class="btn" name="paynow"> Pay Now</button>
              </form>

            
          </div>
        </div>

        <div class="col-25">
          <div class="container">
              
            <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php echo $cart_count; ?></b></span></h4>
            <?php echo $product_list; ?>
              <hr>
  
            <p>Total amount:<span class="price" style="color:black" name="total" value="<?php echo $total;?>"><b>RM <?php echo number_format($total, 2); ?></b></span></p>

          </div>
        </div>
    </div>
</div>

<div class="paynow">
<br>
   <!-- <button type="submit" value="<?php echo $_SESSION['user_id'] ?>" class="btn" name="paynow">Pay Now</button>
   </form> -->
   <form action="shopping_cart.php" >
    <button type="submit" class="backbtn">Cancel</button>
   </form>
  </form>
</div>



</body>

<?php //include("footer.php") ?>






</html>