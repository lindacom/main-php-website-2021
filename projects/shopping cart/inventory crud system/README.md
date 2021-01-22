Book balance and items in stock

inventory.php - view, add and delete books
inventory_edit.php - edit books

Uses database class to insert books using PDO

Create books
--------------
Read books
-----------

```
<?php 
require_once 'dbConnect.php';

$product_list = "";

$sql = "SELECT * FROM books ORDER BY date_added DESC";
$result = mysqli_query($connect, $sql);
$productCount = mysqli_num_rows($result); // count the output amount
if ($productCount > 0) {
	while($row = mysqli_fetch_array($result)){ 
             $id = $row["id"];
			 $title = $row["title"];
			 $price = $row["price"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 $product_list .= "Product ID: $id - <strong>$title</strong> - $$price - <em>Added $date_added</em> &nbsp; &nbsp; &nbsp; <a href='inventory_edit.php?pid=$id'>edit</a> &bull; <a href='inventory.php?deleteid=$id'>delete</a><br />";
             
    }
} else {
	$product_list = "You have no products listed in your store yet";
}
?>
```
```
<div> <?php echo $product_list; ?> </div>
```
Update books
-------------

```
<?php
require_once 'dbConnect.php'; 

// when id appears in the url, gather this book's full information for inserting automatically into the edit form 

if (isset($_GET['pid'])) {
	$targetID = $_GET['pid'];
    $sql = "SELECT * FROM books WHERE id='$targetID' LIMIT 1";
    $result = mysqli_query($connect, $sql);
    $productCount = mysqli_num_rows($result); // count the output amount
    if ($productCount > 0) {
	    while($row = mysqli_fetch_array($result)){ 
             
			 $title = $row["title"];
			 $price = $row["price"];
			 $category = $row["category"];
			// $subcategory = $row["subcategory"];
			 $precis = $row["precis"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
        }
    } else {
	    echo "Sorry that title does not exist.";
		exit();
    }
}
?>
```
```
<?php 
require_once 'dbConnect.php'; 
// when the edit form is submitted, parse the form data and update inventory item to the database
if (isset($_POST['title'])) {
   	
	$pid = mysqli_real_escape_string($connect, $_POST['thisID']);
    $title = mysqli_real_escape_string($connect, $_POST['title']);
	$price = mysqli_real_escape_string($connect, $_POST['price']);
	$category = mysqli_real_escape_string($connect, $_POST['category']);
	$subcategory = mysqli_real_escape_string($connect, $_POST['subcategory']);
	$precis = mysqli_real_escape_string($connect, $_POST['precis']);

    
    // See if that product name is an identical match to another product in the system
	$sql = "UPDATE books SET title='$title', price='$price', precis='$precis', category='$subcategory' WHERE id='$pid' ";


     $result = mysqli_query($connect, $sql);

	if ($_FILES['fileField']['tmp_name'] != "") {
	    // Place image in the folder 
	    $newname = "$pid.jpg";
	    move_uploaded_file($_FILES['fileField']['tmp_name'], "../books/uploads/$newname");
	} 
	header("location: inventory.php"); 
    exit();
}
?> 
```
Delete books
-------------
