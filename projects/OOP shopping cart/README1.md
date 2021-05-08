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

Methods - GET and SET
---------------------
properties can be set to private which means they cannot be accessed outside the class. you can use the set and get (magic) methods to access the properties.
Othe functions include __isset()

N.b the get and set method names start with a double underscore

class Post {
private $name;

public function __set($name, $value) {
echo 'setting' .$name. 'to .$value;
$this->name = $value;
}

public function __get($name) {
echo 'getting' .$name.  $this->name;
}

//instantiate object
$post = new Post;
// set variable 
$post->name = 'testing';
// print variable
echo $post->name;

Static properties and methods
-----------------------------
Used for variables that do not change.  

class User {
pubic $username;
public static $minPassLength = 5;

public static function validatePassword($password) {
if(strlen($password) >= self::$minPassLength) {
return true;
} else {
return false;
}
}
}

N.b when referencing a static property use self:: scope resolution operator instead of $this.

N.b when referencing a static method yu do not need to instantiate an object.  Just use the class name, scope resolution operator and method.

$password = 'pass';

if(User::validatePassword($paword)) {
   echo 'password is valid';
} else {
echo 'password is NOT valid';
}

// access a static property
echo User::$minPassLength;

Class inheritance
-----------------
It is possible to create a class that inherits the properties and methods of another class. enter class name then use the extends keyword followed by the
name of the class it is inheriting from

class First {
public $id = 23;
protected $name = 'John Doe';

public function saySomething(){
    echo 'something...';
}
}

clsss Second extends First {
public function getName() {
echo $this->name;
}

}


$second = new Second;

// access property from inherited class
echo $second->id;

echo $second->getName();

N.b. protected properties cannot be accessed outside the class but can be accessed by a method in an inherited class
N.b. private properties cannot be accessed by inherited class

Abstract classes and methods
----------------------------
Abstract class is used as a base class that other classes extend from e.g. animal class and dog class. You cant instantiate an abstract class.
you instantiate the class that extends the base class

Base class
```
abstract class Animal {
public $name;
public $color;

public function describe() {
return $this->name. 'is' .$this->color;
}
abstract public function makeSound();
}
```
```
class Dog extends Animal {
public function describe(){
return parent::describe();
}
public function makeSound(){
return 'bark';
}

}
```
```
$animal = new Dog();
$animal->name = 'Larry';
$animal->color = 'brown';

echo $animal->describe();
echo $animal->makeSound();

```

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





 
