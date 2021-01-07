Database
===========

Block access to expired member
-------------------------------
Store an expiry date and compare it with today's date.
tbl_customer - CustomerID(int(10)), CustomerName(varChr(30)), password(varChar(255)), expiry(date) 

shoppinglogin.php
loginuser.php


checkout.php - http://lindacom.infinityfreeapp.com/books/checkout.php?customer=linda

Add shipping cost to total
-----------------------------

```
<tr>
<td colspan "4">Shipping</td>

<td> <?php 
if($total < 75) {
echo '$10';
$total += 10;
} else {
echo 'free';
}
?>
</td>
</tr>
```

Saving session variables
--------------------------
Assign session array key, variable name and quantity


```
session_start();
$SESSION['quantity']['daffodils'] = 2;
$SESSION['quantity']['daisies'] = 4;
```

Cancel order
--------------
Clear session when cancel button is clicked

```
if(isset($_POST['cancel'])) {
// clear array
$_SESSION = array();
// destroy session
$_SESSION_destroy();
}
```
