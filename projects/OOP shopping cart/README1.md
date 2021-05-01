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

Sub strings
===========
 if (substr($name, 0, 5) == 'cart_') { // if the format of the first five characters of the session is 'cart_' 

          $id = substr($name, 5, (strlen($name)-5)); //id is everything after 'cart_'  
          
 Objects and classes
 ===================
 ```
 <?php
// creates new customer object and gets results of query from a method in the customer class

$newcustomer = new Customer ($database, $name);
$newcustomer->getCustomerName($database, $name);

echo $newcustomer->getCustomerName($database, $name);
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

loop through results of class method
---------------------------------------
```
foreach($allproducts->showAll($database) as $keys => $values) {
  echo '<tr>';
  
  echo '<td>' .$values["id"]. '</td>';
   echo '<td>' .$values["title"]. '</td>';
  echo '<td></td>';
  echo '</tr>
  }
  ```





 
