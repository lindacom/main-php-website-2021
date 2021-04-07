 <?php 
 session_start();

 
 include 'dbConnect.php';
 
 ?> 

 <!DOCTYPE html>

<html lang="en">

<head>
  
<title>Book details</title>
  
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/js/plugins/foundation.orbit.min.js"></script> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.1.1/motion-ui.min.css" />



 <style>
.title {
    border-bottom: 1px solid #92c100;
    box-shadow: 0 1px 0 #b6f200;
    margin-bottom: 15px;
}

.reset {
    list=style: none !important;
    margin: 0;
    padding: 0;
}

.tiles {
    display: table;
    margin-left: -26px;
    position: relative;
    width: 1012px;
    text-align: center;
}


 
.marketing-site-hero {
  background: url("/images/summerbooks.jpg") top right no-repeat;
  height: 65vh;
  background-size: cover;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-align-items: center;
      -ms-flex-align: center;
          align-items: center;
}

@media screen and (min-width: 40em) {
  .marketing-site-hero {
    background-position: center center;
  }
}

.marketing-site-hero-content {
  max-width: 75rem;
  margin: 0 auto;
  padding-left: 5%;
  padding-right: 5%;
}

.marketing-site-hero-content h1 {
  font-size: 32px;
}

.marketing-site-hero-content .button.round {
  border-radius: 5000px;
  text-transform: uppercase;
  font-size: 12px;
  margin-bottom: 0;
}

@media screen and (min-width: 40em) {
  .marketing-site-hero-content {
    padding-left: 50%;
  }
}

</style>
 

</head>



  
  <body>

   <?php include 'shoppingnav.php';?>

 

  

    <!--HERO  --> 

    <div class="marketing-site-hero">
  <div class="marketing-site-hero-content">
    <h1>Book details</h1>
    <p class="subheader">Search our vast catalogue for a range of books</p>
    <a href="/books/librarysearch.php" class="round button">learn more</a>
  </div>
</div>

     
     <!--main content section  --> 
    
 <div class="home-wrapper">                  
	  


    <h3> <?php
   // get book title from url  
  // $page_name = $connect->real_escape_string($_GET["search"]); 
    $page_name = $_GET["search"]; 
  ?>

 <!--breadcrumb -->  
<nav aria-label="You are here:" role="navigation">
  <ul class="breadcrumbs">
    <li><a href="/books/library.php">Home</a></li>
    <li><a href="/books/librarysearch.php">Library search</a></li>
      <li>
      <span class="show-for-sr">Current: </span> <?php echo $page_name ?>
    </li>
  </ul>
</nav>

<?php
   //put the data together and echo
   echo "
      You searched for: $page_name
      
   ";

?></h3>

<p>Here are books related to your search.  </p>
<?php
//Read Query from books database and dislay on the page using php echo

$stmt= "SELECT title, description, image, price FROM books WHERE title LIKE '%".$page_name."%' ";

$result = $connect->query($stmt);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        echo    '<div class="row">';


        echo    '<div class="columns large-6">';
        echo    '<object data='.$row["image"].' >
    <img src="http://placehold.it/400x250/000/fff" class="shop-item-image" />
  </object>';
  echo    '</div>';
  

  echo    '<div class="columns large-6">';
         echo    '<h3 class="shop-item-title">'.$row["title"].'</h3>';
         echo    '<h3 class="shop-item-title">'.$row["price"].'</h3>';
         echo    '<p>'.$row["description"].'</p>';
 
 echo '<div class="button-group">';

    echo    '<a href="/books/store.php?action=get&title='.$row["title"].'&price='.$row["price"].'&quantity=1 "target="_blank" class="button shop-item-button" style="background-color:#AF824C;"><i class="fa fa-shopping-cart"></i>Buy this book</a>';

echo '<a href="/books/ratings.php?action=get&title='.$row["title"].'" class="button success favourte-button"style="background-color:#4CAF50;">Favourite this book</a>';

echo '<a href="/books/reviewform2.php" class="button secondary"style="background-color:#4C79AF;">Review this book</a>';

 echo    '</div>'; 
     echo    '</div>';
       echo    '</div>';
     
     
  
    echo    '<hr />';
    }
} else {
    echo '0 results: There are no books that match your search please search again.';
    echo '<input type="search" style="width: 20rem;" id="search" placeholder="Quick search...">';
}
$connect->close();

?>


<div class="title clearfix">
<h2 style="float:left">You might also like these other books</h2>
<h3><a href="#" class="feature" style="float:right;">Browse all books ></a></3>
</div>
 
 <ul class="reset tiles">
 <li><a href="#"><img src="" alt="" height="200" width-"200">
 <h3>books</h3>
 <p class-"reset">from £9.99</p>
 </a></li>

  <li><a href="#"><img src="" alt="" height="200" width-"200">
 <h3>books</h3>
 <p class-"reset">from £9.99</p>
 </a></li>

 </ul>
</div>
            

   


      

 <!--FOOTER-->  

                           
            <!--e commerce footer-->                        

          <?php include 'ecommerce-footer.php';?>

        <!--page footer-->
      
 <?php include 'footer.php';?>

 <!--SCRIPTS-->

  	<script>
     // catch enter code in search form in front page 

   $('#search').keyup(function (e) {
    var str = $('#search').val();
    var domain = "/books/bookdetails.php";
    var url = domain+"?search=" + str;
    if (e.keyCode == 13) {
        location.href = url;
    }
});
 
  </script> 

  <!-- FAVOURITES SCRIPT (not working)
  
     <script>
     favourites = [];
if (!isset($_SESSION['favourites']) {
    $session['favourites'] = [];
} 
</script>  -->	                          
 
    
      <script>
      $(document).foundation();  </script> 
 
          </body>
  </html>
