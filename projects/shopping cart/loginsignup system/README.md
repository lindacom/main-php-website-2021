Checkout.php
-----------
CHECK IF USER IS LOGGED IN OTHERWISE REDIRECT TO LOGIN PAGE WITH CURRENT PAGE REF IN THE URL

```
<?php

// do check to see if user logged in
if (!isset($_SESSION["customer"])) {
    echo '<script>alert("you must be logged in ")</script>';
    $_SESSION['customerloggedin'] = $_SERVER['REQUEST_URI']; // Note: $_SERVER['REQUEST_URI'] is your current page which will be 
    //returned back in the session when                                                                  logged in
    header("location: shoppinglogin.php?location=" . urlencode($_SERVER['REQUEST_URI']));
    exit; // prevent further execution, should there be more code that follows
}
 elseif ($_SESSION["expire"] < time()) { //check if session plus limit is less than current time. Not working as session 
 // returns true not a number
    $expired = true;
    require 'logout.php';
} else {
    $_SESSION["start"] = time();
}
?>
```

loginuser.php
-------------------
1. CREATE A LOGIN PAGE AND A LOGIN VALIDATION PAGE THAT SETS THE SESSION AS USERNAME, SESSION START AD EXPIRY TIMES
2. IF THE USERNAME SESSION IS SET REDIRECT TO PREVIOUS PAGE WITH THE USERNAME IN THE URL

```
$username = $_POST['txtuser']; //txtuser is the name in the form field
$password = $_POST['txtpass']; //txtpass is the name in the form field
    // get user from db where details match
$checkuser = "SELECT * FROM tbl_customer WHERE CustomerName ='$username' AND password ='$password' "; 
 
$run = mysqli_query($connect, $checkuser);

if (mysqli_num_rows($run)>0) { // if there is a result    

    while($row = mysqli_fetch_array($run))
 {
   $expiry = new DateTime($row['expiry']); // get expiry date from the db result
 }
 
  if (new DateTime() <= $expiry) { // doesn't allow user to access if expired date in database
      session_start();
   
    $_SESSION['customer'] = $username;  //set the session with the name user_name 

         // setting session start and expire times 10 minutes - Nb. instead of setting session to true it has been set to time
          $_SESSION['start'] = time(); // Taking now logged in time.
            // Ending a session in 30 minutes from the starting time.
            $_SESSION['expire'] = $_SESSION['start'] + (10 * 60);
         
   }  else {
       echo "sorry your subscription has expired on " . $expiry->format('F J, Y') ;
   }
     
if(isset($username)) {

        $url = $_SESSION['customerloggedin']; // redirects to previous page
         $queryb = parse_url($url, PHP_URL_QUERY);
    
   
    if ($queryb) {
        $url .= "&customer=" .$_SESSION['customer']; //if url already has parameters add & username to the end
    } else {
        $url .= "?customer=" .$_SESSION['customer'];
    }
       
          header('Location:'.$url); 
          
        } else {
            header('Location: http://example.com/books/myaccount.php?username=' .$_SESSION['customer']);
 
      }

}
else{
echo "Username and/or password do not match! Try again!";
}
}
```

Shoppinglogin.php
-------------------
ONCE LOGGED IN USE SESSION HANDLER TO STORE SESSION IN THE DATABASE USING PDO CONNECTION AND SESSION HANDLER CLASS

```
<?php 
include 'dbConnect.php';
include 'loginuser.php';
include '../books/includes/db_connect.php';
include '../books/Foundationphp/Sessions/MysqlSessionHandler.php';
?>

<?php
// Storing session data in the database using the session handler php file, session handler class and PDO db connection
// Warning: session_set_save_handler(): Cannot change save handler when session is active
// therefore this code needs to appear before session start

use Foundationphp\Sessions\MysqlSessionHandler;

$handler = new MysqlSessionHandler($db);
session_set_save_handler($handler);

?> 
```
mysqlsessionhandler.php
-----------------------
WRITE SESSION DATA TO THE DATABASE

```
 /**
     * Writes the session data to the database
     *
     * @param string $session_id
     * @param string $data
     * @return bool
     */
    public function write($session_id, $data)
    {
        try {
            $sql = "INSERT INTO $this->table_sess ($this->col_sid,
            $this->col_expiry, $this->col_data)
            VALUES (:sid, :expiry, :data)
            ON DUPLICATE KEY UPDATE
            $this->col_expiry = :expiry,
            $this->col_data = :data";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':expiry', $this->expiry, \PDO::PARAM_INT);
            $stmt->bindParam(':data', $data);
            $stmt->bindParam(':sid', $session_id);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollback();
            }
            throw $e;
        }
    }
    ```
