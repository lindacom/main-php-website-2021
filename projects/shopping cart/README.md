Database
===========

Block access to expired member
-------------------------------

Sign up: 
1. Create a database table with an expiry date field - tbl_customer - CustomerID(int(10)), CustomerName(varChr(30)), password(varChar(255)), expiry(date) 
2. Create a sign up form
3. Store user details including an expiry date in the database 

```
use prepared statement to register new user - signup connection to database and insert post values 
   <?php
  if(isset($_POST["Signup"]))
{
    $sql = "INSERT INTO tbl_customer (CustomerName, email, password, expiry)
                              VALUES (?, ?, ?, ?)";

    $stmt = $connect->prepare($sql);

    $stmt->bind_param("ssss", $customername, $email, $pwd, $expiry);

// set parameters and execute
$customername = $_POST["txtsuuser"];
$email = $_POST["txtsuemail"];
 $pwd = password_hash($_POST["txtsupass"], PASSWORD_DEFAULT);
     $expiry = (new DateTime('last day of this month + 12 months'))->format('Y-m-d');
$stmt->execute();

echo "Account created successfully. Your account will expire on:" ;

?>
```
Login: 
1. Create a login form
2. Create a login validation file
3. compare expiry date with today's date.

```
$checkuser = "SELECT * FROM tbl_customer WHERE CustomerName ='$username' AND password ='$password' ";
 
 $run = mysqli_query($connect, $checkuser);



if (mysqli_num_rows($run)>0) {

    // doesn't allow user to access if expired date in database

    while($row = mysqli_fetch_array($run))
 {
   $expiry = new DateTime($row['expiry']);
 }
 
  if (new DateTime() <= $expiry) {
    //set the session with the name user_name 
    $_SESSION['customer'] = $username;
// setting session start and expire times 10 minutes
 $_SESSION['start'] = time(); // Taking now logged in time.
            // Ending a session in 30 minutes from the starting time.
            $_SESSION['expire'] = $_SESSION['start'] + (10 * 60);
         //    $_SESSION["customer"] = true;
   }  else {
       echo "sorry your subscription has expired on " . $expiry->format('F J, Y');
   }
```

shoppinglogin.php
loginuser.php
checkout.php 

Add shipping cost to total
-----------------------------

```
<tr>
<td colspan "4">Shipping</td>

<td> <?php 
if($total < 75) {
echo '$10';
$total += 10;
} else {
echo 'free';
}
?>
</td>
</tr>
```
Sessions
============
To set session time limit:
1.Store the current time in a session variable
2.set a time limit in seconds
3.compare session variable + time liit to current time
If less, log user out and destroy session
otherwise, update session variable to current time

Checkout.php - if user is not logged in send them to the login page with details of the current page (to be redirected to after login) 

```
<?php
session_start()

// do check to see if user logged in
if (!isset($_SESSION["customer"])) {
    echo '<script>alert("you must be logged in ")</script>';
    $_SESSION['customerloggedin'] = $_SERVER['REQUEST_URI']; 
    // Note: $_SERVER['REQUEST_URI'] is your current page which will be returned back in the session when logged in
    header("location: shoppinglogin.php?location=" . urlencode($_SERVER['REQUEST_URI']));
    exit; // prevent further execution, should there be more code that follows
}
?>
```
Saving session variables
--------------------------


Assign session array key, variable name and quantity


```
session_start();
$SESSION['quantity']['daffodils'] = 2;
$SESSION['quantity']['daisies'] = 4;
```

Cancel order
--------------
Clear session when cancel button is clicked

```
if(isset($_POST['cancel'])) {
// clear array
$_SESSION = array();
// destroy session
$_SESSION_destroy();
}
```
