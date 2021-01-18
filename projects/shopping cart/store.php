<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
?> 

<?php
    session_start();

 if(isset($_GET['title']) && $_GET['title'] !== ""){ //if there is a book title in the url
   
    // IF THERE IS ALREADY A SESSION  
      if(isset($_SESSION["cart"]))  // if there is a cart session
      {  
           $item_array_id = array_column($_SESSION["cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  // if the id in the url is not already in the array
           {  
                $count = count($_SESSION["cart"]);  // count number of items in the cart
                $item_array = array(  // get id, title, price and quantity from the url and store in array
                     'item_id'               =>     $_GET["id"],
                   'item_name' =>     $_GET["title"], 
                    'item_price'          =>    $_GET["price"], 
                     'item_quantity'          =>     $_GET["quantity"]
                );  
                $_SESSION["cart"][$count] = $item_array;  // store item array in cart session
           }  
           else  
           {  
                echo '<script>alert("Item Already Added")</script>';  
                echo '<script>window.location="librarysearch.php"</script>';  
           }  
      }  

      // IF A SESSION DOES NOT ALREADY EXIST
      else  
      {  
           $item_array = array(  // create an array using id, title, price and quantity from url
                'item_id'               =>     $_GET["id"],
                   'item_name' =>     $_GET["title"], 
                    'item_price'          =>    $_GET["price"], 
                     'item_quantity'          =>     $_GET["quantity"]
           );  
           $_SESSION["cart"][0] = $item_array;  // store item array in cart session
      } 
     
 }
      ?>

   

<!-- unset session when url action is delete -->
<?php   

   if(isset($_GET["action"]))  
 {  
     if($_GET["action"] == "delete")  // if the selectd action is delete
      {  
           foreach($_SESSION["cart"] as $keys => $values)  // look through the cart
           {  
                if($values["item_id"] == $_GET["id"])  // if an id in the cart equals the id in the rul
                {                     
                  unset($_SESSION["cart"][$keys]);  // remove the key from the cart session
                     echo '<script>alert("Item Removed")</script>';  
                     echo '<script>window.location="librarysearch.php"</script>';  
                }  
           }  
      }  
 }
 ?>

<?php include 'dbConnect.php'; ?> 

<!DOCTYPE html>
<html>
    <head>
        <title>Shopping cart</title>
      <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="/css/app.scss">
   <link rel="stylesheet" type="text/css" href="/css/modules.scss">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.0/css/foundation.min.css">
<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.0/js/foundation.min.js"></script> 
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.0/js/plugins/foundation.orbit.min.js"></script> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.1.1/motion-ui.min.css" />

<style>
.btn.checkout {
    background: #ffbf00;
    border-radius: 11px;
    color: #312e1d;
    padding-left: 22px;
    padding-right: 22px;
    text-shadow: 0 1px 2px #fff;
}

.btn.cancel {
    background: #3f90af;
    border-radius: 11px;
    color: #fff;
    padding-left: 22px;
    padding-right: 22px;
    text-shadow: 0 1px 2px #fff;
}
</style>
       
        
    </head>
    <body>
  

<!--NAVIGATION -->


<?php include 'shoppingnav.php';?>


<!-- content area -->

<div class="grid-container">
 <div class="grid-x grid-margin-x"> 

<!--TWO COLUMN LAYOUT -->

<div class="cell small-2"></div>

<!-- left -->

 <div class="cell small-8">

 

<!--shopping cart -->     
        
                 
           
          
                          <h2>Shopping cart</h2>
<!-- breadcrumb -->
<nav aria-label="You are here:" role="navigation">
  <ul class="breadcrumbs">
    <li><a href="/books/library.php">Home</a></li>
    <li><a href="/books/librarysearch.php">Library search</a></li>
   
    <li>
      <span class="show-for-sr">Current: </span> Shopping cart
    </li>
  </ul>

  

</nav>

<div class="clearfix">
<div class="float-right"><a href="/books/librarysearch.php"> << Continue shopping</a></div></div>
            
                                                   <div class="callout clearfix">
                                                   <div class="float-left"><span style="color:blue"><i class="fa fa-truck fa-5x"></i><p>For delivery</p></div>
  
  <!-- count number of items in the cart -->
  <div class="float-right"> <span class="price" style="color:black"><i class="fa fa-shopping-cart fa-5x"></i> <b><?php 
echo sizeof($_SESSION['cart']);?></b></span></div>
</div>

         
<p style="color:red;text-align:center;" >Free shipping on orders over £30!!</p>

<div class="clearfix">
<div class="float-left"><h3>Your order</h3></div>
<div class="float-right"><a href="/books/checkout.php"><button class="success button" type="button">Continue to payment > </button></a></div>
<hr />
</div>

   
 <p>Please check the details of your order</p>             

                         <!-- display the contents of the cart -->
                          <?php   
                          if(!empty($_SESSION["cart"]))  
                          {  
                               $total = 0;  
   ?> 
                                  <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="20%">Item Name</th>  
                               <th width="10%">Quantity</th>  
                               <th width="10%">Quantity</th> 
                               <th width="20%">Price</th>                                 
                               <th width="15%">Total</th>  
                               <th width="20%">VAT</th>
                               <th width="5%">Action</th>  
                          </tr> 
  <?php
  // loop through cart and display key and value
                               foreach($_SESSION["cart"] as $keys => $values)  
                               {  
                          ?>  
                          <tr>  
                                <!-- ITEM NAME  -->
                               <td><?php echo $values["item_name"]; ?></td>  

                                  <!-- QUANTITY  -->
                               <td><?php echo $values["item_quantity"]; ?></td>  
                         
                         <!-- QUANTITY (test) -->
                              <td> 
                              <div class="input-group input-number-group"> 
                           <input class="input-number" type="number" value="<?php echo $values["item_quantity"]; ?>"  style="width:70px" > 
                              </div>
                            </td> 
 <!-- PRICE -->

                             <td>$ <?php echo $values["item_price"]; ?></td> 

                           
 <!-- TOTAL -->
                            
                                   <?php   $total = $total + ($values["item_quantity"] * $values["item_price"]);?>
                              <td>$ <?php echo $total; ?></td> 

                               <!-- VAT -->
                          <?php 
                               $tax = round( ($total / 100) * 20, 2);?>
                              <td>$ <?php echo $tax; ?> </td>

                               <!-- remove action link -->
                                <td><a href="store.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>   
                         

                            </tr>
                          <?php 
                          } 
                         ?>
                                                
                          <?php  
                          
                          } 
                          ?>  
                     </table> 
                     </div>

<!-- if there are items in the cart display the action buttons -->
           <?php  if(isset($_SESSION["cart"])) {
                   
                   
                   echo ' <div class="btn-group align-center">';
                     echo   '<div> <a href="/books/checkout.php"><button class="success button large" type="button">PAYMENT</button></a></div>';
                                      echo '<div><a href="/books/logout.php"><button class="danger button small" type="button">Cancel order</button></a></div>';
                                        echo '</div>';
                 
        
           ?>

           
            
            <?php
            } else {
               echo 'You have no items in the cart';
           }
           ?>
            
      
      </div> 
     

     
<div class="cell small-2"></div>
</div>
</div> 

<!--footer -->

               <div>
   
            <!--e commerce footer-->                        

         <?php include 'ecommerce-footer.php'?>

        <!--page footer-->
      
 <?php include 'footer.php'?>

</div> 

<!-- SCRIPTS -->

<!-- set value of input box quantity attribute
 set url to equal quantity attribute -->

    <script>
                     // quantity input box - when increase/decrease clicked the value attribute is set to this umber
                     $('.input-number').click(function() {
 var set = $(this).val();
$(this).attr("value", set);


 var _href = $(this).attr("value"); //get the value 
 var _url = location.href; // get current url
var urlParams = _href;
 window.location.search = 'quantity=' + urlParams;
               // $(this).attr("href", _href + set); //add user inputted quantity to the button href as a parameter 
});
</script>


    </body>
</html>
