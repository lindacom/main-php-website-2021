
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

// last inserted ID
public function lastInsertID() {
   $this->dbh->lastInsertId();
   }

// result set (for the data to be returned to)
//return associaive array
public function resultset() {
$this->execute();
retur $this->stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
```
3. include the database file in the index file 

```
// n.b. required class file should come before dbconnect file in order to use the mysql class (contained in that file) 
for database connection.

require 'classes/Customer.php'; 
require 'dbConnect.php';
```

4. create new database object

Class files
============
1. dbConnect.php
2. classes/Mysql.php

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

PDO query - fetch data using database class
----------------------------------------------
```
require 'classes/Database.php

$database = new Database;

$database->query('select * FROM books');
$rows = $database->resultset();

// print array
print_r($rows);

//loop through array

foreach($rows as $row) {
echo $ow['title'];
}
```

N.b. to get individual records add bind parameter after the query

```
$database->query('select * FROM books WHERE id = :id');
$database->bind(':id, 1');
```

PDO query - insert data from a form using database class
------------------------------------------------------------
```
$databse = new Database;
// sanitize form input
$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

//check if form submitted and asign input to variables

if($post['submit']) {
$title = $post['title'];
$body = $post['body'];

//database query
$database->query('INSERT INTO books (title, body) VALUES(:title, :body)');
$database->bind(':title', $title);
$database->bind(':tbody', $body);
$database->execute();
// check if record inserted
  if($database->lastInsertId()) {
  echo 'book added';
  }
  }
  ```
```
<h3>Add book </h3>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<label>Book Title</label><br />
<input type="text" name="title" placeholder="add a title..." /><<br /><br />
<label>Book Body</label><br />
<textarea name="body"></textarea><<br /><br />
<input type="submit" name="submit" value="submit" />
</form>

```

PDO query - update  data using database class
------------------------------------------------------------
```
$databse = new Database;
// sanitize form input
$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

//check if form submitted and asign input to variables

if($post['submit']) {
$id = $post['id'];
$title = $post['title'];
$body = $post['body'];

//database query
$database->query('UPDATE books SET title = :title, body = :body WHERE id = :id)');

$database->bind(':id', $id);
$database->bind(':title', $title);
$database->bind(':tbody', $body);
$database->execute();
  }
  ```
```
<h3>Update book </h3>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
  <label>Book ID</label><br />
<input type="text" name="id" placeholder="specify id" /><<br /><br />
<label>Book Title</label><br />
<input type="text" name="title" placeholder="add a title..." /><<br /><br />
<label>Book Body</label><br />
<textarea name="body"></textarea><<br /><br />
<input type="submit" name="submit" value="submit" />
</form>
```

PDO query - delete data on button click using database class
------------------------------------------------------------

```
$databse = new Database;

//check if form submitted and asign input to variables
if($_POST['delete']) {
$delete_id = $_POST['delete_id'];
//database query
$database->query('DELETE FROM books WHERE id = :id)');
$database->bind(':id', $delete_id);
$database->execute();
}

  ```
```
<h3>Update book </h3>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
  <label>Book ID</label><br />
<input type="text" name="id" placeholder="specify id" /><<br /><br />
<label>Book Title</label><br />
<input type="text" name="title" placeholder="add a title..." /><<br /><br />
<label>Book Body</label><br />
<textarea name="body"></textarea><<br /><br />
<input type="submit" name="submit" value="submit" />
</form>

<h3>Books</h3>
<div>

//loop through array

<?php foreach($rows as $row) : ?>
<div>
<h3><?php echo $ow['title']; ?></h3>
<p><?php echo $ow['body']; ?></p>
<br />
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="delete_id" value="<?php echo $ow['id']; ?>" />
<input type="submit" name="delete" value="delete" />
</form>
</div>
<?php endforeach; ?>
</div>
}
```


fetch associative array
=======================

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
================================

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
======================================================

N.b object performs database query and returns array

```
$newcustomer = new Customer ($database, $name);
$newuser = $newcustomer->getCustomerName($database, $name);

 print_r($newcustomer->getCustomerName($database, $name)); // associative array

print_r( $newuser["address"]); // access individual value from associative array
```
