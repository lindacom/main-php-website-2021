<?php
// Start the session
session_start();

?>

<?php  
//query for category filter dropdown
$connect = mysqli_connect("server", "user", "password", "database");
 $query = "
SELECT category
FROM books
GROUP BY category
";
$result =  mysqli_query($connect, $query);
?>



<!DOCTYPE html>
<html>
  <head>
    <title>Live Data Search in PHP using Ajax</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="/css/app.scss">
   <link rel="stylesheet" type="text/css" href="http://lindacom.infinityfreeapp.com/css/modules.scss">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.0/css/foundation.min.css">
<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.0/js/foundation.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.0/js/plugins/foundation.orbit.min.js"></script> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.1.1/motion-ui.min.css" />



<style>
.sbox {
    background-color: #DDD;
	padding: 15px;
	margin-bottom: 15px;

}

.fbox {
   border-style: solid;
background-color: var(--yellow);
	padding: 15px;
	margin-bottom: 15px;
}
</style>
  </head>
  <body>

<!-- navigation -->

<?php include 'shoppingnav.php';?> 



<!-- COLUMNS -->
<div class="grid-container">
  <div class="grid-x grid-margin-x">

  <!-- left -->

  <div class="cell medium-4">

<!-- search filter panel design taken from foundation building blocks-->

  <div class="product-filters fbox">
  <ul class="mobile-product-filters vertical menu hide-for-small-only" data-accordion-menu>
   <li>
     <h2>Filter by</h2>  
     <ul class="vertical menu" data-accordion-menu>

     <!-- filter section -->
      <li class="product-filters-tab">
        <p>Category</p>
        <ul class="categories-menu menu vertical nested is-active">
           <a href="#" class="clear-all" id="category-clear-all" onClick="window.location.reload();">Clear All</a> 
           <li id="dynamic_categories"></li>
           
           </ul>
    </li>

             <!-- filter section -->
      <li class="product-filters-tab">
        <p>Authors</p>
        <ul class="categories-menu menu vertical nested is-active">
           <a href="#" class="clear-all" id="category-clear-all" onClick="window.location.reload();">Clear All</a> 
           <li id="dynamic_authors"></li>
           
           </ul>
    </li>

             <!-- filter section -->
      <li class="product-filters-tab">
        <p>Price</p>
        <ul class="categories-menu menu vertical nested is-active">
           <a href="#" class="clear-all" id="category-clear-all" onClick="window.location.reload();">Clear All</a> 
           <li id="dynamic_price"></li>

                             </ul>
    </li>

             <!-- filter section -->
      <li class="product-filters-tab">
        <p>Other filters</p>
        <ul class="categories-menu menu vertical nested is-active">
           <a href="#" class="clear-all" id="category-clear-all" onClick="window.location.reload();">Clear All</a> <br />
            <a href="#" id="featured">Featured</a><br />
           <a href="#" id="lowest-price">Lowest price</a>
          <div>  <a href="#" id="five-stars">Highest reviews</a>
            
   <span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
                   </div>
           
</ul>
    </li>
  </ul>  
  </li>
  </ul> 
</div> <!-- end of search filter panel design -->

  
  
   
   
    
    
   </div>
   

<!-- right column with dynamic books table-->

<div class="cell medium-8">

   
      <h3 align="center">Library search</h3>
      


      <div class="row">
      <div class="columns large-6">
        <strong>Search results </strong><br>
        
        <!-- clock-->

        <?php
$hour = date("H:i:sa");
echo "Today is " . date("d/m/Y") . "<br>";
date_default_timezone_set("Europe/London");
echo "The time is " . $hour;

if ($hour > 5 && $hour <12) { ?>
<p>Good morning.</p>
<?php } elseif ($hour >=12 && $hour < 18) { ?>
<p>Good afternoon.</p>
<?php } else { ?>
<p>The library is closed.  Go home!</p>
<?php } 
?>


<!-- welcome message displayed if loged in-->
 <?php 
    if(isset($_SESSION['user_name'])) { 
        echo 'Welcome &nbsp';
        echo $_SESSION['user_name'];
    }
    ?>
</div>

<div class="columns large-6">

<!-- category dropdown -->


    <h2>Filter by category</h2>
     <select name="category_list" id="category_list" class="form-control">
      <option value="">Select Category</option>
      <?php 
      while($row = mysqli_fetch_array($result))
      {
       echo '<option value="'.$row["category"].'">'.$row["category"].'</option>';
      }
      ?>
     </select>


    
    
    </div>
    
   </div>

<!-- search box-->
        <div class="sbox">
        <h2>Search</h2>
          <div class="form-group ">
            <input type="text" name="search_box" id="search_box" class="form-control" placeholder="Search by title, author or category" >
          </div>
        </div>
            
            <!-- dynamic books list -->

          <div class="table-responsive" id="dynamic_content"></div>
         
        </div>
 <!-- dynamic pagination -->
<ul class="pagination">
        <li><a href="?pageno=1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
    </ul>





      </div>
    </div>

   </div>

</div>

</div> <!-- END OF TWO COLUMN FORMAT -->
    </div> 
  
<script>
// Scripts to run when page loads - product filter panel, list of books
  $(document).ready(function(){
load_data(1)
load_categorydata(1)
load_authorsdata(1)
load_pricedata(1)

    });

    
   // list of books 

    function load_data(page, query = '')
    {
         $.ajax({
        url:"fetchall.php",
        method:"POST",
        data:{page:page, query:query},
        success:function(data)
        {
          $('#dynamic_content').html(data);
        }
      });
    }

   /* $('.button').on('click',function(){
       $url = '';
       $url .= "&customer=" .$_SESSION['customer']; //if url already has parameters add & username to the end
   
    });*/
       
    

    // search box
    $(document).on('click', '.page-link', function(){
      var page = $(this).data('page_number');
      var query = $('#search_box').val();
      load_data(page, query);
    });

    $('#search_box').keyup(function(){
      var query = $('#search_box').val();
      load_data(1, query);
    });

     
   

    // list of categories

  function load_categorydata(page, query = '')
    {
      $.ajax({
        url:"fetchcategories.php",
        method:"POST",
        data:{page:page, query:query},
        success:function(data)
        {
          $('#dynamic_categories').html(data);
        }
      });
    }

// list of authors
    function load_authorsdata(page, query = '')
    {
      $.ajax({
        url:"fetchauthors.php",
        method:"POST",
        data:{page:page, query:query},
        success:function(data)
        {
          $('#dynamic_authors').html(data);
        }
      });
    }
// list of book prices
    
    function load_pricedata(page, query = '')
    {
      $.ajax({
        url:"fetchpricerange.php",
        method:"POST",
        data:{page:page, query:query},
        success:function(data)
        {
          $('#dynamic_price').html(data);
        }
      });
    }
   
    </script>


   

    <!-- FILTER ON CLICK SCRIPTS -->

    <script>

     $('#category_list').change(function(){
          var query = $(this).val();
load_data(1, query);
    });

// featured
 $("#featured").click(function(){
    $.ajax({
        url: "fetchfeatured.php",
        method: "POST",
        data: 'id=' + $(this).attr('value'),
        success: function(data){
            $("#dynamic_content").html(data);
        }
    });
});

// lowest price

 $("#lowest-price").click(function(){
    $.ajax({
        url: "fetchlowest.php",
        method: "POST",
        data: 'id=' + $(this).attr('value'),
        success: function(data){
            $("#dynamic_content").html(data);
        }
    });
});

// five stars
    $("#five-stars").click(function(){
    $.ajax({
        url: "fetchlikes.php",
        method: "POST",
        data: 'id=' + $(this).attr('value'),
        success: function(data){
            $("#dynamic_content").html(data);
        }
    });
});

</script>

<!-- PRODUCT FILTERS SCRIPTS -->


<!--CHANGE VALUE OF INPUT FIELD AFTER USER INPUT - input trigers a change and te change amends value attribute -->


<script>

var myinput = []; //empty array

$('#inputbox').on('input',function() { //detect input in quantity input box
    $('#inputbox').val('quantity').trigger("change"); // detect quantity change and trigger a change event
});

$(document).on("change",'#inputbox' ,function() { // detect change event on input box
    var work = $(this).val(); // get the value of the input box and assign it to the variable called work
    $('#inputbox').attr("value", work); // set input box attribute value to the inputted value

    myinput.push(work); // push the inputted value to the empty myinput array for use by the button click function

    // button click function 
    
              $('.button').on('click',function() {

                var _href = $(this).attr("href"); //get the href of the clicked button link
                $(this).attr("href", _href + myinput); //add user inputted quantity to the button href as a parameter 

                //  var _href = $(this).attr("href").replace('quantity=1', ''); //get the href of the clicked button link
                //  $(this).attr("href", _href + 'quantity=' + myinput); //add user inputted quantity to the button href as a parameter 
                
               });


    });

  </script>

<!-- CHECKBOX CHECK, HASH PARAMETER AND SEARCH .each iterates over the DOM elements that are part of the jQuery object-->
  <script>
  function marked (param1)     {     

     var filter = []; //set the empty filter array
      
    $('.category:checked, .authors:checked, .price:checked').each(function () {   //detect if a checbox with the class category is checked
      
    filter.splice(1,1); // delete existing elements in filter array
      filter.push($(this).val()); // push value of checked box to the filter array  
     
          $('.category').not(this).prop('checked', false); // uncheck boxes that are not selected box

     sub = filter[0]; //get the first element in the filter array
     location.hash = sub; //enter parameter as hash in the url - this works 


     query = decodeURIComponent(window.location.hash.substr(1) ); // removes blank spaces from hash and gets the first element after the hash
     alert(query) ; //alert item in the array
     load_data(1, query); //send query to the load_data function to filter the book results table
           });
        
           }

  </script>

 <!--<script>

  function marked (param1)     { // on checkbox change send row data as a parameter  - row data is incorrect - will only pass numbers not text
        
     location.hash = (param1); //enter parameter as hash in the url - this works      
      var filter = []; //set the empty filter array
        
       $(param1).each(function(){
            filter.push($(this)); //loop through the parameters and put in the empty array
        
        var filterStr = JSON.stringify(filter); //change array using json stringify
$.ajax({
    url: 'filters-file.php', //send a post request to this file with the filter data - this file is empty
    type: 'post',
    data: {filter: filterStr},
    success: function(response){
      alert(response); //when reponse is received alert the response (this can be removed after testing)
       var query = (response); //use the response as a query and send the query to the load_data function to search the books dynamic table by titl3
load_data(1, query);
    }
});
            
        });
        
  } 
   </script> -->
  
    
     <!-- FILTER EVENT SCRIPTS FOR REFERENCE (NOT WORKING)

   function checked ( )     {

    var check = false;
    
if($('.category-clear-selection category').prop('checked') == true ){
    check = $('.category-clear-selection category').attr('id');
    
 } 

 $.ajax({
    type: "POST",
    url: "fetchmarked.php",
    data: { check:check},
    success: function(data) {
        alert(data);
    }
})
};



     if ($(this).is(':checked')) {
            alert("You have elected to show your checkout history."); //checked
        }
        else {
           alert("gone."); //unchecked
        
    }


// get value of one checked checkbox in the url
// location.hash = $("input[type='checkbox']").val();-->

    <!-- category click to search using search box not working 
<script>
function load_categoriesclick(page, query = '') {
    $("#Coaching").click(function(event){event.preventDefault(); load_data().val(page, query = 'Coaching').keyup(); });
    $('#Leadership').click(function(event){event.preventDefault();$('#search_box').val( "Leadership" ).focus().keyup();});
   
   };
   
   </script> -->

  <!--not working - if url shows featured get element clicked
   <script>  
 if(window.location.hash === "featured"){
document.getElementById("featured").click();
}   
</script> -->

<!-- not working change background color when a catetory is clicked
<script>
    function load_categoriesclick(page, query = '')
   {
  $(a).filter(".Coaching").css("background-color", "yellow");
});
</script> -->

<!-- not working ru function when category coaching is clicked
<script>
var el = document.getElementById('Coaching');
el.onclick = load_data();
</script> -->

<!-- THREE SCRIPTS - PRODUCT FILTER SCRIPTS EXAMPLE NOT working

<script>
$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var brand = get_filter('brand');
        var ram = get_filter('ram');
        var storage = get_filter('storage');
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, brand:brand, ram:ram, storage:storage},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    https://www.webslesson.info/2018/08/how-to-make-product-filter-in-php-using-ajax.html
</script>

<!-- hash script notworking  
<script>
var hash = window.location.hash, //get the hash from url
    cleanhash = hash.replace("#", ""); //remove the #
    //alert(cleanhash);

     if (exists(cleanhash) {
      var query = $hash;
      load_data(1, query);
    });
</script> 
-->


<!-- <?php
$hash = "<script>document.writeln(cleanhash);</script>";
echo $hash;
?> -->


</body>
</html>
</body>
</html>
</body>
</html>
