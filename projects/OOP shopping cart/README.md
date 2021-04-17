Display errors
==============

```
<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
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



Sub strings
===========
 if (substr($name, 0, 5) == 'cart_') { // if the format of the first five characters of the session is 'cart_' 

          $id = substr($name, 5, (strlen($name)-5)); //id is everything after 'cart_'  
