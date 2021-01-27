Breadcrumb
===========
```
<nav aria-label="You are here:" role="navigation">
  <ul class="breadcrumbs">
    <li><a href="/books/library.php">Home</a></li>
    <li><a href="/books/librarysearch.php">Library search</a></li>
   
    <li>
      <span class="show-for-sr">Current: </span> Shopping cart
    </li>
  </ul>
</nav>
```


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
=================

Testing
---------
To test user sign up test:
1. submit blank form - required fields
2. enter name and non matching password - password does not match

loginuser.php
--------------

checkout.php 
--------------

database class
----------------
Use database class (for insert, select, update and delete queries)
```
$db = new Database();
       $db->insertRow("INSERT INTO orders(CustomerName, email, orderdetails) VALUES('$customer', '$email', '$myitems' )");
```


 count number of items in the cart
 ==================================
 
 ```
  <div class="float-right"> <span class="price" style="color:black"><i class="fa fa-shopping-cart fa-5x"></i> <b><?php 
echo sizeof($_SESSION['cart']);?></b></span></div>
</div>
```

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

Switch statement:

```
$total = $total;
$deliery = '';

switch ($total) {

case $total < 10:
$delivery = 10;
break;

case $ total > 10 && $total < 30:
$delivery = 5;
break;

case $total > 30:
$delivery = 'FREE';
break;

}

echo $delivery;
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
