
Database connection
==================

1. dbConnect.php
2. classes/Mysql.php
3. 

in html file:

```
// n.b. required class file should come before dbconnect file in order to use the mysql class (contained in that file) 
for database connection.

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
            echo '<p>'.$get_row['title'].'<br />'.$get_row['title'].'<br />'.$get_row['description']. '<br />'.
            number_format($get_row['price'], 2).' <a href="cart.php?add='.$get_row['id'].'">Add to cart</a></p>';
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

create new object, fetch individual value from array
-----------------------------------------------------

N.b object performs database query and returns array

```
$newcustomer = new Customer ($database, $name);
$newuser = $newcustomer->getCustomerName($database, $name);

 print_r($newcustomer->getCustomerName($database, $name)); // associative array

print_r( $newuser["address"]); // access individual value from associative array
```
