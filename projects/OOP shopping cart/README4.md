
Database connection
==================

1. Create Mysql database and tables.
2. Create database class - connection, constructor.

PDO - php database object.

```
class Database {
private $host = 'localhost';
private $user = 'root';
private $pass = '1234';
privat $dbname = 'mydatabase';

priate $dbh; // database handler
private $error;
private $stmt;

// construct function
pulic function __construct() {
// set DSN
$dsn = 'mysql:host='. $this->host. ';dbname='. $this->dbname;
//set options
$options = array(
PDO::ATTR_PERSISTENT => true,
PDO::ATTR_ERRMODE -> PDO::ERRMODE_EXCEPTION
);
//create new PDO
try {
$this->dbh = new PDO($dsn, %this->user, $this->pass, $options)
} catch (POException $e) {
$this->error = $e->getMessage();
}
}

// query function

public function query($query) {
$this->stmt = $this->dbh->prepare($query);
}

// bind function (to bind data)
// checking what data is being passed and bind accordingly

public function bind($param, $value, $type = null){
if(is_null($type)) {
switch(true) {
case is_int($value): $type = PDO::PARAM_INT;
break;
case is_bool($value): $type = PDO::PARAM_BOOL;
break;
case is_NULL($value): $type = PDO::PARAM_NULL;
break;
DEFAULT: $type = PDO::PARAM_STR;
}


}
$this->stmt->bindValue($param, $value, $type);
}
// execute function - executes prepared statement
public function execute() {
return $this->stmt->execute();
}


// result set (for the data to be returned to)
//return associaive array
public function resultset() {
$this->execute();
retur $this->stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
```
3. include the database file in the index file - create new database object

**dbConnect.php
**classes/Mysql.php

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
