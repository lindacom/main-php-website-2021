Arrays
=======

basic (one dimensional) array - made up of keys
$myArray = array("milk", 4, 3, "juice", "eggs");

associative array - made up of key value pairs
$myArray = array("item_title" => mybook, "quantity" => 2);

multidiensional array - key of arrays within an array
$myArray = array(
1 => array (
"item_title" => mybook,
"quantity" => 1
),
2 => array (
"item_title" => secondbook,
"quantity" -> 4
),
)

N.b. multidimensional array can have as many basic or associative arrays as you want.  They can also be mixed arrays.  

add item to multidimensional array:
array_push($_SESSION["cart"], array("itm_id" => $pid, "quantity" => 1));
