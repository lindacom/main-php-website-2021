Display errors
==============

```
<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
?> 
```

include a file
==============
```
<?php require 'cart.php'; 
?>
```

get url data
=============

```
<?php 
$name = $_GET['name'];
echo $name;
?>
```

Sessions
=========

Start session
--------------

```
<?php

session_start();
```

store array in session
-----------------------
```
  $item_array = array( 
                             'item_name' =>  $title,
                              'item_value' =>  $value,
                              'item_price' => $price,
                              'item_sub' =>  $sub 

                                );  

                                 
              
$_SESSION["cart"] = $item_array;
```

Conditional store array in session - check if session array already exists
--------------------------------------------------------------------------

```
// ARRAY OF BOOK DETAILS
if(isset($_SESSION["mytitles"])){
      $count = count($_SESSION["mytitles"]);  // count number of items in the cart
 $item_array = array(  // create a multidimensional array using id, title, price and quantity from url
                'item_id'               =>     $_GET["id"],
                   'item_name' =>     $_GET["title"], 
                    'item_price'          =>    $_GET["price"], 
                     'item_quantity'          =>     $_GET["quantity"]
           );  
           $_SESSION["mytitles"][$count] = $item_array;  // store item array in cart session
} else {
    $item_array = array(  // create a multidimensional array using id, title, price and quantity from url
                'item_id'               =>     $_GET["id"],
                   'item_name' =>     $_GET["title"], 
                    'item_price'          =>    $_GET["price"], 
                     'item_quantity'          =>     $_GET["quantity"]
           ); 
    $_SESSION["mytitles"][0] = $item_array;
}
echo '<pre>',print_r( $_SESSION["mytitles"]) ,'</pre>';
```

loop through session
------------------------
```
 foreach ($_SESSION["cart"] as $key=>$item){
  
    echo $item; 
         }
```

Database connection
==================

in html file:

```
// n.b. required class file should come before dbconnect file in order to use the mysql class (contained in that file) for database connection.

require 'classes/Customer.php'; 
require 'dbConnect.php';
```

in class file:

```
include 'Mysql.php';

// constructor

  function __construct(DB $database)
        {

            $this->database = $database;
        // call to function
        $this->showAll($database);

        } 
        
// function
public function showAll($connect)
{
```

Database queries
================
fetch associative array
----------------------

```
function products() {

  $query = "SELECT id, title, description, price from books WHERE quantity > 0 ORDER BY id DESC";

  $result = mysqli_query($connect, $query);

  if(mysqli_num_rows($result) == 0) {
    echo "There are no products to display";
      }
        else {
          while ($get_row = mysqli_fetch_assoc($result)) {
            echo '<p>'.$get_row['title'].'<br />'.$get_row['title'].'<br />'.$get_row['description']. '<br />'.number_format($get_row['price'], 2).' <a href="cart.php?add='.$get_row['id'].'">Add to cart</a></p>';
                }
}
```

fetch all (used for a collection)
---------------------------

```
public function showAll($connect)
{

    $query = $this->database->query("SELECT * FROM books");
     $result = $query->fetchAll();
     
     if($result == 0) { 
    echo "There are no products to display"; 
    } else { 
        while ($result > 0) { 
            return $result;
              }

  } }
  
```



Sub strings
===========
 if (substr($name, 0, 5) == 'cart_') { // if the format of the first five characters of the session is 'cart_' 

          $id = substr($name, 5, (strlen($name)-5)); //id is everything after 'cart_'  
          
 Objects and classes
 ===================
 
 <?php
// creates new customer object and gets results of query from the method in customer class
$newcustomer = new Customer ($database, $name);
$newcustomer->getCustomerName($database, $name);

echo $newcustomer->getCustomerName($database, $name);
?>
 
