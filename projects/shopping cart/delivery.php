<?php
session_start();
?> 

<?php include 'dbConnect.php';?> 

<!DOCTYPE html>

<html lang="en">

<head>
  
<title>Book a delivery slot</title>
  
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
 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/js/plugins/foundation.orbit.min.js"></script> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.1.1/motion-ui.min.css" />
</head>
  
  <body>

   <!-- NAVIGATION -->

   <?php include 'shoppingnav.php';?>

<?php if(!empty($_SESSION["cart"]))  { 
   
    echo 'hi' .$_SESSION['firstname'];
    echo '<strong>Address:</strong>' .$_SESSION["address"];
}
?>

<p>Thanks a bunch for filling that out. It means a lot to us, just like you do!</p>

        <h2>Book a delivery slot</h2>

         <!-- shortest distance between two locations -->

         <?php 
         function getDistance(array $locaion1, array $location2, $precision = 0, $useMiles = true) {
             // get the earth's radius in miles of kilimeters
             $radius = $useMiles ? 3955.00465 : 6364.963;
            // convert lattitude from r=degrees to radians
            $lat1 = deg2rad($location1[0]);
            $lat2 = deg2rad($location2[0]);
            // get the difference between longitudes and convert to radians
            $long = deg2rad($location2[1] - $location1[1]);
           // calculate the distance
           return round(acos(sin($lat1) * sin($lat2) + cos($lat1) * cos($lat2) * cos($long)) * $radius, $precision);
         }
         $ny = [40.758895, -73.9873197];
         $la = [33.914329, -118.2849236];
         $trafalgar = [51.5080917, -0.1291379];
         $palace = [51.5013673,-0.1440787];

         echo 'you are ' . getDistance($trafalgar, $palace, 2) . ' miles from the depot in' . $palace;
         ?>

         <p> Book a delivery time from the options below to do - if delivery already booked change button text to amend booking</p>

         <form action="" method="get">
  <input type="checkbox" name="Monday" value="Monday">
  <label for="Monday"> Monday</label><br>
  <input type="checkbox" name="Tuesday" value="Tuesday">
  <label for="Tuesday"> Tuesday</label><br>
  <input type="checkbox" name="Wednesday" value="Wednesday" checked>
  <label for="Wednesday">Wednesday</label><br><br>
  <!-- submit/processing delivery button  -->

         <!--submit -->
       <div class="ecommerce-loading-button text-center">
        <div class="loading-button">

        <button type="button" id="button1" class="primary button" data-loading-start>submit Book delivery</button> 
     
        <!-- processing -->
       <button type="button" class="primary button hide" id="processed" value="0" data-loading-end> 
         <i class='fa fa-refresh fa-spin'></i> Processing booking
        </button> 

         <!-- refresh message -->
       <div data-success-message class="callout success hide" >
         Thanks, your delivery has been booked!
       </div> 

       </div>  <!-- end of booking confirmation interactive buttons and message -->
        </div> 
</form>

            

                  


    </div> 



</div>


<script>

var newUrl = 'http://lindacom.infinityfreeapp.com/books/thankyou.php?delivery=yes';

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
    window.location.href = newUrl;
  //  history.pushState({}, null, newUrl); // add url parameter 'delivery' without refreshing the page
   }, 5000);

    $('#processed').attr("value", 1); //changes the value from 0 to 1 on the processing button

   

   // window.location.href = window.location.href + "?single";
   // $.POST('#processed');
});


</script>
    </body>
    </html>