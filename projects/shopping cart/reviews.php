<?php
// public view of the commnt reviews
// Start the session
session_start();
?>

<?php include "shoppingnav.php"?>
<?php include "dbConnect.php"?>

<!DOCTYPE html>
<html>
 <head>
  <title>Book reviews</title>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="/css/app.scss">
   <link rel="stylesheet" type="text/css" href="/css/modules.scss">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.0/css/foundation.min.css">
<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.0/js/foundation.min.js"></script> 
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.0/js/plugins/foundation.orbit.min.js"></script> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.1.1/motion-ui.min.css" />          
       
 </head>
 <body>

<!-- comments -->
<div class="grid-container">
  <div class="grid-x grid-margin-x">
    
    <div class="cell small-8">
  
  <h3>Comments (2)</h3>
  <a href="reviewform2.php" class="button">Add a comment</a>

  <div id="result"></div>
 
</div>

</div>
</div>
<!--/comments-->


<!-- SCRIPTS -->

  <script>
$(document).ready(function(){
 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"fetchreviews.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
});
</script>
  
 </body>
</html>



