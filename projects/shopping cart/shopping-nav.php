 <?php
 if(!isset($_SESSION)) {
session_start();
 }
?>

 <!--NAVIGATION -->

  <!--mobile  

  <div class="title-bar" data-responsive-toggle="example-menu" data-hide-for="medium">
  <button class="menu-icon" type="button" data-toggle="example-menu"></button>
  <div class="title-bar-title">Menu</div>
</div> -->


<!--large screen  -->
<div class="top-bar" id="example-menu" style="background-color: #AF4CAB !important; margin-bottom:20px;">
  
  <div class="top-bar-left">
    <ul class="dropdown menu" style="background-color: #AF4CAB !important;" data-dropdown-menu>
      <li class="menu-text">The book store</li>
      
         <li>
         <a href="/books/library.php">Home</a>
         <!-- <ul class="menu vertical"> -->
   
    
    </li>       
                     <!-- </ul> -->
  </div>


  <div class="top-bar-right">

    <ul class="dropdown menu" style="background-color: #AF4CAB !important;" data-dropdown-menu>
    
  
    
    <?php 
    if(isset($_SESSION['customer'])) { 
        echo '<li>Logged in as:' . $_SESSION['customer'].  '</li>';  
        ?>
       
         <!-- <li>My profile</li> -->
       <!-- <ul class="menu vertical" style="background-color: #eea29a !important;"> -->
            <ul class="menu" style="background-color: #eea29a !important;">  
         
         <li> <a href="myprofile.php">My profile</a><ul class="menu vertical"></li>
       <li> <a href="myaccount.php">My account</a></li>
      <li> <a href="myorders.php">My orders</a></li></ul>
         </ul>
         
   </li>
   <?php
    }
    else {
        echo '<li><a href="/books/shoppinglogin.php">Sign in</a></li>';
    } 
    ?>
 
    
    <li> <a href="/books/reviews.php">Reviews</a></li>

        <li> <a href="/books/ratings.php">Ratings</a></li>
   
   <?php if(isset($_SESSION['customer'])) { 

        echo '<li> <a href="/books/logout.php">Logout </a></li>';
        echo  '<li> <a href="/books/reviewform2.php">My reviews</a></li>';
        
    } ?>
   
    <li><a href="/books/store.php" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span>Basket 
    <?php 
    if(isset($_SESSION['cart'])) {
        echo '<span class="badge">';
echo  sizeof($_SESSION['cart']); 
echo ' </span>';
 } ?>
</a></li>
      
    </ul>
  </div>
</div> 



<script>
$(document).foundation();
</script>
 
