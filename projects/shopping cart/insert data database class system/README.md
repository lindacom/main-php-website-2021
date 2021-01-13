Checkout.php
---------------
Send all variable details in a session to thank you page when payment button is clicked

Thankyou.php
-------------
If the order is placed insert details into the database using the query and the database class insert row function.

```
 if(isset($_GET['ordered'])) {
         
         if (($_GET['ordered']) == 'yes') {     
       $db = new Database();
       $db->insertRow("INSERT INTO orders(CustomerName, email, orderdetails, total, orderDate) 
           VALUES('$customer', '$email', '$myitems', '$mysum', '$date' )");
       echo 'You have successfully created an order';
              }
	
       session_destroy();
    } 
```

Database.php
------------
A class to connect to the database and insert a row into a table

```
class Database {
  public $isConn;
  protected $datab;

  // connect to db
  public function __construct($username ="", $password = "", $host = "", $dbname = "", $options = [] ){
     $this->isConn = TRUE;
     try {
         $this->datab = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
         $this->datab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $this->datab->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
     } catch (PDOException $e) {
         throw new Exception($e->getMessage());
     }
     }

// disconnect from the db
public function Disconnect() {
    $this->datab = NULL;
    $this->isConn = FALSE;
}

//insert row
    public function insertRow($query) {
    try {
        $stmt = $this->datab->prepare($query);
         $stmt->execute();
        return TRUE;
            } catch (PDOException $e) {
                throw new Exception($e->getMessage());
            }
}
```
