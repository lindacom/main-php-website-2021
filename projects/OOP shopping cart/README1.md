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

get url data and assign to a variable
======================================

```
<?php 
$name = $_GET['name'];
echo $name;
?>
```

Conditional - get url data or redirect page
-------------------------------------------

```
if(isset($_GET["title"]))  {
$id = $_GET["id"];
$title = $_GET["title"];
$price = $_GET["price"];
$quantity = $_GET["quantity"];
} else {
    header ('location: products.php');
}
```

Sub strings
===========
 if (substr($name, 0, 5) == 'cart_') { // if the format of the first five characters of the session is 'cart_' 

          $id = substr($name, 5, (strlen($name)-5)); //id is everything after 'cart_'  
          }
          
Classes
========
Classes have properties (attributes) and methods (functions). 

class User {

public $id;
public $username;
public $email;
public $password;

public function login($username, $password) {

// set variables
$his->username = $username;
$this->password = $password;

   echo 'username:' . $username . 'is now logged in';
}

}

N.b you can set default values for properties. eg public $id - 44;
N.b. to access a public property in a method use $this-> followed by property name. e.g. $this->id;
N.b constructor runs code when class is instantiated. can be used for setting up default properties. 
N.b. to call a function within another function within the class use $this-> followed by the function name.
N.b. destructor runs at the end of code. can be used for closing database connections.


// instantiate class
$User = new User;
$User->login('brad', '1234');

          
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

put objects in array and print the array
-----------------------------------------

```
 $keying[] = new Product($id, $title, $price); 

              print "<pre>";
print_r($keying);
print "</pre>";
```

Get individual values from an array object
-----------------------------------------

```
print_r( $_SESSION["firstcustomer"]["CustomerName"]);
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

Access array items
------------------

echo $item_array["item_value"];

remove last item in array
-------------------------
array_pop($item_array);

remove first item in array
--------------------------

array_shift($item_array);

print the array
---------------

print_r($item_array);

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
Loops
======

for loop - print 0 to five
--------------------

for($i=0; $i <=5; $i++) {
echo $i;
}

While loop
---------
N.b. the variable must be set outside

$i=0;
while($i <=5) {
echo 'number' .$i. '<br />';
$i++;
}



N.b. foreach loop is used specifically for arrays


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
  
  Loop through multidimensional array
  -----------------------------------
  
  ```
  foreach($array as $me){
               foreach($me as $k=>$v){
            $this->$k = $v; 
                 
               }    
        print  'ITEM NAME: ' .$this->item_name.'PRICE:' .$this->item_price. 'QUANTITY:' .$this->item_quantity.
                      '<br>';  
     }
 ```
  
  Print size of session
  ----------------------
  
  ```
   <?php 
  if(isset($_SESSION['mytitles'])) {
echo sizeof($_SESSION['mytitles']);
  }?>
  ```
  
  functions
  ===========
  block of code that can be used repeatedly in a program.
  
  function with default parameters
  ---------------------------------
  N.b. the value passed as a parameter will override the default parameter.  If no parameter is passed then the default parameter will be used
  
  function greet ($greeting, $name = 'John') {
       echo $greeting. ' ' .$name;
  }
  
  greet('welome');





 
