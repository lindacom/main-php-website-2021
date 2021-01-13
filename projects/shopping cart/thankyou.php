 <?php
session_start();
?>

<?php include 'dbConnect.php';
?>

<?php

if(!empty($_SESSION["cart"]))  {  

$date = date('Y-m-d H:i:s');        
$customer = $_SESSION['firstname'];
$email =  $_SESSION['email'];

                                                            foreach($_SESSION["cart"] as $keys => $values) {
                                                              $myitems = $values["item_name"]; 
                                                              $mytotals =  $mytotals + ($values["item_quantity"] * $values["item_price"]); 
                                                              $mysum = number_format($mytotals, 2);  
                                                            }
                          }
	// TO DO - INSERT DELIVERY DETAILS INTO DATABASE
	 if(isset($_GET['ordered'])) {
         if (($_GET['ordered']) == 'yes') {      

        $query = "INSERT INTO orders(CustomerName, email, orderdetails, total, orderDate) VALUES('$customer', '$email', '$myitems', '$mysum', '$date' )";
              if (mysqli_query($connect, $query)) {
                      $status = 'You have successfully created an order';
                                              		} else {
			$statusErr = 'ERROR: '. mysqli_error($connect);                       
        }
                } else {
                    echo 'goodbye'; //you can use this later for when order = no - unsuccessful order
                }
	
        session_destroy();
    }    
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
  
<title>Book a delivery</title>
  
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="/css/app.scss">
   <link rel="stylesheet" href="/css/modules.scss">
    <link rel="stylesheet" type="text/css" href="/css/productcard.scss">
     <link rel="stylesheet" type="text/css" href="/css/footer.scss">
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/foundation/6.2.4/foundation.min.css">
     <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/js/foundation.min.js"></script>
 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/js/plugins/foundation.orbit.min.js"></script> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.1.1/motion-ui.min.css" />
<style>
 
 .cbox {
    background-color: #DDD;
	padding: 15px;
	margin-bottom: 15px;
}
</style>

</head>
  
  <body>

   <!-- NAVIGATION -->

   <?php include 'shoppingnav.php';?>


 <!-- TWO COLUMN LAYOUT -->

   <div class="grid-container">
  <div class="grid-x grid-margin-x">

    <h2>Order confirmation</h2>

    <!-- left  -->
    <div class="columns large-6">	

	<div class="float-left show" id="confirmmsg">
		<i class="fa fa-check main-content__checkmark" id="checkmark"></i>
		<p>Thanks a bunch for filling that out. It means a lot to us, just like you do!</p>
<h3>Step one:</h3>
        <a href="delivery.php" type="button" id="buttonA" class="success button">Book a delivery slot</a>


      <?php  if(isset($_GET['delivery'])) {
         if (($_GET['delivery']) == 'yes') { ?>

        <h3>Step two:</h3>
        <p> Please review your order and click the submit order button. </p>
        
        </div>
        
         <!-- submit/processing order button  -->

         <!--submit -->
        
        <div class="ecommerce-loading-button text-center">
        <div class="loading-button">

        <button type="button" id="button1" class="primary button" data-loading-start>Submit Order</button>
     
        <!-- processing -->
        <button type="button" class="primary button hide" id="processed" value="0" data-loading-end> 
         <i class='fa fa-refresh fa-spin'></i> Processing Order
        </button>
         <!-- refresh message -->
       
       <div data-success-message class="callout success hide" >
         Thanks, your order has been processed!
       </div> 

       </div><!-- end of order confirmation interactive buttons and message -->
        </div>
<?php
         } } else {
             echo 'please book a delivery slot';
         } ?>
        
<!-- ORDER CONFIRMATION -->
	
<div data-success class="hide">
    
    <?php
echo "All session variables are now removed, and the session is destroyed.<br>"
?>
<h3>Your order will be sent to:</h3>
<strong>Name:</strong> <?php echo $_SESSION["firstname"]; ?><br>
<strong>Email:</strong> <?php echo $_SESSION["email"]; ?><br>
<strong>Address:</strong> <?php echo $_SESSION["address"]; ?><br>
<strong>City:</strong> <?php echo $_SESSION["city"]; ?><br>
<strong>Town:</strong> <?php echo $_SESSION["town"]; ?><br>
<strong>Postcode:</strong> <?php echo $_SESSION["postcode"]; ?><br>

<h3>Shipping address</h3>
<p> (if different from billing address)</p>
<strong>Shipping address:</strong> <?php echo $_SESSION["shipaddress"]; ?><br>
<strong>City:</strong> <?php echo $_SESSION["shipcity"]; ?><br>
<strong>Town:</strong> <?php echo $_SESSION["shiptown"]; ?><br>
<strong>Postcode:</strong> <?php echo $_SESSION["shippostcode"]; ?><br>

<h3>Order details</h3>
<strong>Product:</strong><?php foreach($_SESSION["cart"] as $keys => $values)  {  
                         echo $values["item_name"]; }?><br> 
 
 <strong>Order total:</strong> <?php echo $mysum ; ?><br>
<h3>Payment details</h3>
<strong>Cardname:</strong> <?php echo $_SESSION["cardname"]; ?><br>
<strong>Card number:</strong> <?php echo $masked; ?> <br>
<strong>Card expiry month:</strong> <?php echo $_SESSION["expmonth"]; ?><br>
<strong>Card expiry year:</strong> <?php echo $_SESSION["expyear"]; ?><br>
<strong>CVV: </strong><?php echo $maskedcvv; ?> <br>

</div>
</div> <!-- end of left column -->

<!-- right column -->

<!-- show/hide cart button                
                   <button type="button" id="toggle-cart" class="success button" onclick="toggleFunction()">Show/hide cart</button>  -->

<div class="columns large-6">
                   
                   <!-- SHOPPING CART -->

 <div id="cartsummary" class="checkout-summary cbox show">      

               <h3 class="checkout-summary-title">Cart</h3>
                 <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php 
echo sizeof($_SESSION['cart']);?></b></span>

                     <div class="checkout-summary-item">  
                           <div class="table-responsive">  
                     
                     <table class="table table-bordered">  
                          <tr>  
                               <th>Item Name</th>  
                                 <th>Quantity</th> 
                                                             <th>Total</th>                             
                          </tr>  
                          <?php   
                          if(!empty($_SESSION["cart"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["cart"] as $keys => $values)  
                               {  
                          ?>  
                          <tr>  
                               <td><?php echo $values["item_name"]; ?></td>  

                                 <!-- QUANTITY  -->
                               <td><?php echo $values["item_quantity"]; ?></td>  
                         
                           <!--   <td> 
                              <div class="input-group input-number-group"> 
                              <input class="input-number" type="number" value="<?php echo $values["item_quantity"]; ?>" min="1" max="10" style="width:70px"> 
                              </div>
                            </td> -->

                                <!-- item total -->
                               <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>  
                                                       </tr>  

                          <!-- order total -->
                          <?php  
                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                               }  
                          ?>  
                          <tr>  
                               <td><strong>Total</strong></td>  
                               <td></td>
                               <td><strong>£ <?php echo number_format($total, 2); ?></strong></td>  
                             
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table> 
                     </div>
    
</div>



    </div> 


</div>






  
<hr style="border-bottom:5px;border-bottom-style:dotted;border-color:#e3e3e3;">
        
 </div> 


</div>
 
    
                        

 

 <!--SCRIPTS -->


<!--submit/processing order button with success message -->
<script>

var newUrl = 'http://lindacom.infinityfreeapp.com/books/thankyou.php?ordered=yes';

$('[data-loading-start]').click(function() {
  $(this).addClass('hide');
  $(this).parent().find('[data-loading-end]').removeClass('hide');
  setTimeout(function() {
    $('[data-loading-start]').removeClass('hide');
    $('[data-loading-end]').addClass('hide');
    $('[data-success-message]').removeClass('hide');
 
  $('[data-success]').removeClass('hide')

   $('#cartsummary').addClass('hide'); //hide shopping cart
    $('#confirmmsg').addClass('hide'); //hide order confirmation message
    history.pushState({}, null, newUrl); // add url parameter 'ordered' without refreshing the page
   }, 5000);

    $('#processed').attr("value", 1); //changes the value from 0 to 1 on the processing button

   

   // window.location.href = window.location.href + "?single";
   // $.POST('#processed');
});


</script>

<!-- <script>
                     // quantity input box
                     $('.input-number').click(function() {
 var set = $(this).val();
$(this).attr("value", set);

</script> -->



    </body>
    </html>
