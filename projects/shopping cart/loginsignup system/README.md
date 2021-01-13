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

Shoppinglogin.php
-------------------
CREATE A LOGIN PAGE AND A LOGIN VALIDATION PAGE
