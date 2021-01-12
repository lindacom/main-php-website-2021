<?php
session_start();
?>

<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
?> 


<?php include 'testinput.php';?>
<?php include 'dbConnect.php';?> 



<!-- CHECK IF USER IS LOGGED IN -->
<?php

// do check to see if user logged in
if (!isset($_SESSION["customer"])) {
    echo '<script>alert("you must be logged in ")</script>';
    $_SESSION['customerloggedin'] = $_SERVER['REQUEST_URI']; // Note: $_SERVER['REQUEST_URI'] is your current page which will be returned back in the session when                                                                  logged in
    header("location: shoppinglogin.php?location=" . urlencode($_SERVER['REQUEST_URI']));
    exit; // prevent further execution, should there be more code that follows
}
 elseif ($_SESSION["expire"] < time()) { //check if session plus limit is less than current time. Not working as session returns true not a number
    $expired = true;
    require 'logout.php';
} else {
    $_SESSION["start"] = time();
}
?>

<!-- TO DO if user changes stord details and refreshes page new details should be stored, if address in database is blank user should be abl to insert a address-->
<?php
// do check to see if user logged in and get their contact details
if (isset($_SESSION["customer"])) {
  $customer = $_SESSION['customer'];
       
        $stmt= "SELECT * FROM tbl_customer WHERE CustomerName = '$customer' ";
$result = $connect->query($stmt);

$fetchRow = mysqli_fetch_assoc($result);



$connect->close();
}
?>


<!DOCTYPE html>

<html lang="en">

<head>
  
<title>Checkout</title>
  
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="http://lindacom.infinityfreeapp.com/css/app.scss">
   <link rel="stylesheet" href="http://lindacom.infinityfreeapp.com/css/modules.scss">
    <link rel="stylesheet" type="text/css" href="http://lindacom.infinityfreeapp.com/css/productcard.scss">
     <link rel="stylesheet" type="text/css" href="http://lindacom.infinityfreeapp.com/css/footer.scss">
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/foundation/6.2.4/foundation.min.css">
     <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/js/foundation.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/js/plugins/foundation.orbit.min.js"></script> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.1.1/motion-ui.min.css" />

  <script src="http://lindacom.infinityfreeapp.com/js/store.js" async></script> <!-- provides the code for the shopping cart -->
 
<style>
.cbox {    // grey background for search box
    background-color: #DDD;
	padding: 15px;
	margin-bottom: 15px;
}
</style>
</head>



  
  <body>

  <!-- NAVIGATION-->

   <?php include 'shoppingnav.php';?>

   
<div class="home-wrapper">
 
<h2>Responsive Checkout Form</h2>


<!-- back button -->
<button type="button" class="success button" onclick="goBack()">Back</button>




<!-- 3 COLUMN LAYOUT-->

 
    <div class="row">

    <!-- left-->

         <div class="columns large-4">
         
         
  
      <form id="billing" name="billing-form" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >

      
       
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label><span class="error">* <?php echo $firstnameErr;?></span> <!-- shows errors on the page -->
            <input type="text" id="fname" name="firstname" placeholder="John Doe" value="<?php echo $fetchRow['fullName']?>" readonly>   <!-- keeps the input value in the text box -->                                                                             
            
            
           
            <label for="email"><i class="fa fa-envelope"></i> Email</label> <span class="error">* <?php echo $emailErr;?></span>
            <input type="text" id="email" name="email" placeholder="john@example.com" value="<?php echo $fetchRow['email']?>" readonly>

            <!--value="<?php echo $email;?>"-->
           
            
            <label for="adr"><i class="fa fa-address-card"></i> Address</label> <span class="error">* <?php echo $addressErr;?></span>
            <input type="text" id="adr" name="address" value="<?php echo $fetchRow['address']?>" readonly>
          <!--"<?php echo $address;?>"-->
            
            <label for="city"><i class="fa fa-university"></i> City</label>
            <input type="text" id="city" name="city" value="<?php echo $fetchRow['city']?>" readonly>
           <!-- "<?php echo $city;?>"-->

            <label for="town">Town</label>
            <input type="text" id="town" name="town" value="<?php echo $fetchRow['town']?>" readonly >
           <!-- "<?php echo $town;?>"-->
             
            <label for="postcode">Postcode</label> <span class="error">* <?php echo $postcodeErr;?></span>
            <input type="text" id="postcode" name="postcode" value="<?php echo $fetchRow['postcode']?>" readonly>
           <!-- "<?php echo $postcode;?>"-->
           
              
          </div>

 <!-- middle column-->
<div class="columns large-4">
                     
                     <h3>Payment</h3>
            <hr />
            <label for="fname">Accepted Cards</label>

             <!-- card icons-->
          
          <a href="#" id="visa">   <i class="fab fa-cc-visa fa-w-18 fa-3x" style="size:50px"; "color:navy;" ></i></a>
            <a href="#" id="amex">    <i class="fab fa-cc-amex fa-w-18 fa-3x" style="color:blue;"></i></a>
            <a href="#" id="mastercard">   <i class="fab fa-cc-mastercard fa-w-18 fa-3x" style="color:red;"></i></a>
            <a href="#" id="discover">   <i class="fab fa-cc-discover fa-w-18 fa-3x" style="color:orange;"></i></a>

              <hr />
            
            <label for="cname">Name on Card</label><span class="error">* <?php echo $cardnameErr;?></span>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe">
             
            
            <label for="ccnum">Card number</label><span class="error">* <?php echo $cardnumberErr;?> <?php echo $cardnumberErr2;?></span>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            
             <label for="ccnum"></label><span class="error">* <?php echo $cardnumberErr;?> <?php echo $cardnumberErr2;?></span>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            
            <label for="expmonth">Exp Month</label><span class="error">* <?php echo $expmonthErr;?></span>
           <!-- <input type="text" id="expmonth" name="expmonth" placeholder="September"> -->
           

<select name="expmonth" id="expmonth">
<option value="">Select a month</option>
  <option value="january">January</option>
  <option value="february">February</option>
  <option value="march">March</option>
  <option value="april">April</option>
  <option value="may">May</option>
  <option value="june">June</option>
  <option value="july">July</option>
  <option value="august">August</option>
  <option value="september">September</option>
  <option value="october">October</option>
  <option value="november">November</option>
  <option value="december">December</option>
</select>
            
            
            <label for="expyear">Exp Year</label><span class="error">* <?php echo $expyearErr;?></span> 
        <!--    <input type="text" id="expyear" name="expyear" placeholder="2020"> -->

        <select name="expyear" id="expyear">
<option value="">Select a year</option>
  <option value="2020">2020</option>
  <option value="2021">2021</option>
  <option value="2022">2022</option>
  <option value="2023">2023</option>
  <option value="2024">2024</option>
  <option value="2025">2025</option>
  <option value="2026">2026</option>
  <option value="2027">2027</option>
  <option value="2028">2028</option>
  <option value="2029">2029</option>
  <option value="2030">2030</option>
  <option value="2031">2031</option>
</select>
           
              
              
            <label for="cvv">CVV</label><span class="error">* <?php echo $cvvErr;?> <?php echo $cvvErr2;?></span> 
            <input type="text" id="cvv" name="cvv" placeholder="352">
             
              
               
        <label>
          <input type="checkbox" checked="checked" name="sameadr" onclick="toggleAddress()"> Shipping address is the same as billing address
        </label>

        <div style="display:none" id="shipadd">
        <label for="shipadr"><i class="fa fa-address-card"></i> Address</label> 
            <input type="text" id="shipadr" name="shipaddress" value="<?php echo $shipaddress;?>">
          
            
            <label for="shipcity"><i class="fa fa-university"></i> City</label>
            <input type="text" id="shipcity" name="shipcity" value="<?php echo $shipcity;?>">

            <label for="shiptown">Town</label>
            <input type="text" id="shiptown" name="shiptown" value="<?php echo $shiptown;?>" >
             
            <label for="shippostcode">Postcode</label> <span class="error">* <?php echo $shippostcodeErr;?></span>
            <input type="text" id="shippostcode" name="shippostcode" value="<?php echo $shippostcode;?>">
            </div>
      
      <!-- button to clear the form -->
      
      <button type="button" id="billing" onclick="clearformFunction()" class="success button">Clear form</button>

     
      <button class="button" type="submit" name="submitform" id="btn2" >Submit form</button>
     

       

      </form>
    </div> <!-- end of column -->

<!-- SCRIPT TO SEND FORM DATA TO THE DATABASE (cart details not being inputted) -->

    <?php

  if($error == false){
  

    $sql = "
    INSERT INTO orders (CustomerName, email, orderdetails)
    VALUES (' ".$_POST["firstname"]."','".$_POST["email"]."', '.$val.')
    ";

    $result = mysqli_query($connect,$sql);
    

      }

?> 
  

<!-- right -->

   <div class="columns large-4">

                 <div class="row">
                 <div class="columns large-6">
                      
                      <!-- button and div for testing if cookies is working 

<button type="button" class="success button" onclick="showCookies()">show cookies</button>
</div> -->

<!-- show and hide cart button -->

                <div class="columns large-12"> 

                   <h3>Cart</h3>
                   <!--<div class="checkout-summary-title">Cart</div>-->
                <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php 
echo sizeof($_SESSION['cart']);?></b></span><button type="button" id="toggle-cart" class="success button" onclick="toggleFunction()">Show/hide cart</button> </div>

             </div>



<!-- <div id="demo"></div> -->
     

<!-- SHOPPING CART -->

 <div id="cartsummary" class="checkout-summary cbox">   

<div class="checkout-summary-item">
 
                           <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th>Item Name</th>  
                              <th>Quantity</th> 
                           <!--   <th>Quantity</th> -->
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
                         
                          <!-- QUANTITY box 
                              <td> 
                              <div class="input-group input-number-group"> 
                              <input class="input-number" type="number" value="<?php echo $values["item_quantity"]; ?>" min="1" max="10" style="width:70px"> 
                              </div>
                            </td> -->

                                 
                                 <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>  
                               
                          </tr>  

                            

                          <!-- TOTAL -->
                          <?php  
                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                               }  
                          ?>  
                          <tr>  
                               <td colspan="3"><strong>Total</strong></td>  
                               <td colspan="3"><strong>$ <?php echo number_format($total, 2); ?></strong></td>  
                               <td></td>  
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table> 
                     </div>



    </div> 
  
  
  </div> <!-- End of three column layout -->

</div>

<!-- SCRIPTS -->

<!--card number field formatting insert dashes 
<script>
$("#ccnum").mask("9999-9999-9999-9999");
</script>-->

<script>

 $('#amex').click(function(event){
        
        event.preventDefault();
        var like = 3;
   // alert(like);
     $('#ccnum').attr("value", like);
   
});

 $('#visa').click(function(event){
        
        event.preventDefault();
        var like = 4;
   // alert(like);
     $('#ccnum').attr("value", like);
   
});

$('#mastercard').click(function(event){
        
        event.preventDefault();
        var like = 5;
   // alert(like);
     $('#ccnum').attr("value", like);
   
});

$('#discover').click(function(event){
        
        event.preventDefault();
        var like = 6;
   // alert(like);
     $('#ccnum').attr("value", like);
   
});
</script>


<!--form timeout -->
<script>
var timeleft = 60 * 2;
var el = document.getElementById('time-remaining');
var timerID = setInterval(function() {

var minutes, seconds;

timeleft= timeleft - 1;

minutes = parseInt(timeleft / 60);
seconds = timeleft % 60;

if (String(seconds).length == 1) {
seconds = "0" + seconds;
}

if (timeleft <= 0) {
clearInterval(timerID);
}

el.innerHTML = minutes + ":" + seconds;
}, 1000);
</script>

<!--back button using browser history -->
  <script>
function goBack() {
  window.history.back()
}
</script>

<!-- cookies associated with this document.-->
<script>
function showCookies() {
  document.getElementById("demo").innerHTML =
  "Cookies associated with this document: " + document.cookie;
}
</script>

<!--reset billingform -->
<script>
function clearformFunction() {
  document.getElementById("billing").reset();
}
</script>



<!--toggle cart -->

<script>
function toggleFunction() {
  var x = document.getElementById("cartsummary");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>

<!--toggle shipping address -->

<script>
function toggleAddress() {
  var x = document.getElementById("shipadd");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
</body>
</html>






