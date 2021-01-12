Sessions
============

Shopping basket - SET SESSION
-------------------------------

```
<?php
    session_start();

 if(isset($_GET['title']) && $_GET['title'] !== ""){ //if there is a book title in the url
   
    // IF THERE IS ALREADY A SESSION  
      if(isset($_SESSION["cart"]))  // if there is a cart session
      {  
           $item_array_id = array_column($_SESSION["cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  // if the id in the url is not already in the array
           {  
                $count = count($_SESSION["cart"]);  // count number of items in the cart
                $item_array = array(  // get id, title, price and quantity from the url and store in array
                     'item_id'               =>     $_GET["id"],
                   'item_name' =>     $_GET["title"], 
                    'item_price'          =>    $_GET["price"], 
                     'item_quantity'          =>     $_GET["quantity"]
                );  
                $_SESSION["cart"][$count] = $item_array;  // store item array in cart session
           }  
           else  
           {  
                echo '<script>alert("Item Already Added")</script>';  
                echo '<script>window.location="librarysearch.php"</script>';  
           }  
      }  

      // IF A SESSION DOES NOT ALREADY EXIST
      else  
      {  
           $item_array = array(  // create an array using id, title, price and quantity from url
                'item_id'               =>     $_GET["id"],
                   'item_name' =>     $_GET["title"], 
                    'item_price'          =>    $_GET["price"], 
                     'item_quantity'          =>     $_GET["quantity"]
           );  
           $_SESSION["cart"][0] = $item_array;  // store item array in cart session
      } 
     
 }
 ```
 
 UNSET SESSION
 --------------
 
```
<!-- unset session when url action is delete -->
<?php   

   if(isset($_GET["action"]))  
 {  
     if($_GET["action"] == "delete")  // if the selectd action is delete
      {  
           foreach($_SESSION["cart"] as $keys => $values)  // look through the cart
           {  
                if($values["item_id"] == $_GET["id"])  // if an id in the cart equals the id in the rul
                {                     
                  unset($_SESSION["cart"][$keys]);  // remove the key from the cart session
                     echo '<script>alert("Item Removed")</script>';  
                     echo '<script>window.location="librarysearch.php"</script>';  
                }  
           }  
      }  
 }
 ?>
 ```
To set session time limit:
-----------------------------

1. Store the current time in a session variable
2. set a time limit in seconds
3. compare session variable + time liit to current time

If less, log user out and destroy session
otherwise, update session variable to current time

Checkout.php - if user is not logged in 
----------------------------------------
if user is not logged insend them to the login page with details of the current page (to be redirected to after login). Else if session has expired
go to set expired variable to true and go to logout page. Else set session start to current time.

```
<?php
session_start()
// do check to see if user logged in
if (!isset($_SESSION["customer"])) {
    echo '<script>alert("you must be logged in ")</script>';
    $_SESSION['customerloggedin'] = $_SERVER['REQUEST_URI']; // Note: $_SERVER['REQUEST_URI'] is your current page which will be returned back in the session when                                                                  logged in
    header("location: shoppinglogin.php?location=" . urlencode($_SERVER['REQUEST_URI']));
    exit; // prevent further execution, should there be more code that follows
}
 elseif ($_SESSION["expire"] < time()) { //check if session plus limit is less than current time. Not working as session returns true not a number
    $expired = true;
    require 'logout.php';
} else {
    $_SESSION["start"] = time();
}
?>
```

Store session data in database
------------------------------

1. Create database tables to store user data, session data and auto login data
2. Create session handler file - create a session handler class that uses the SessionHandlerInterface
3. In login page connect to database, include the session handler file and use session_set_save_handler() method to store data in the database.

```

<?php include '../books/includes/db_connect.php';?>
<?php include '../books/Foundationphp/Sessions/MysqlSessionHandler.php';?>

<?php
// Storing session data in the database using the session handler php file, session handler class and PDO db connection
// Warning: session_set_save_handler(): Cannot change save handler when session is active
// therefore this code needs to appear before session start

use Foundationphp\Sessions\MysqlSessionHandler;

// N.b. you need to create an instance of the class in every page that uses sesions and ave object as an argument to session. 
set_save_handler before calling session start

$handler = new MysqlSessionHandler($db);
session_set_save_handler($handler);

?> 
<?php
session_start();
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
