<?php
include 'shoppingnav.php';
include 'dbConnect.php';
?>

<?php

	// Check For Submit
	if(isset($_POST['submit'])){
		// Get form data
		
              $booktitle = mysqli_real_escape_string($connect, $_POST['booktitle']);

                 // TO DO - INSERT USER SELECTION INTO LIKES OR INSERT INPUT INTO DISLIKES	2. ADD UP TOTAL LIKES
             $query =  "UPDATE books SET likes = '2' WHERE title = '$booktitle'";
             
            		if(mysqli_query($connect, $query)){
			echo 'Your review has been submitted and you will soon be redirected to the library landing page';
header('Refresh: 5;url=/books/library.php');
		} else {
			echo 'ERROR: '. mysqli_error($connect);
		}
	}
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Rate a book</title>
 <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="/css/app.scss">
   <link rel="stylesheet" type="text/css" href="/css/modules.scss">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.0/css/foundation.min.css">
 <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.0/js/foundation.min.js"></script> 
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.0/js/plugins/foundation.orbit.min.js"></script> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.1.1/motion-ui.min.css" />       
       
 </head>


 <body>

 
 
  <div class="grid-container"  >
  <div class="grid-x grid-margin-x">
    <div class="cell small-6" style="margin: 50 auto;">


<!-- comment form -->
<form class="comment-section-form" method="post" id="form_wall">
  <div class="comment-section-box" style="background-color:#AF4C7A;">
    <div class="row">
      <div class="small-12 column">
        <h2>Rate a book</h2>
       <p>TO DO - if there is a get hide the book list dropdown if there is no GET hide inpt box and display dropdown.</p>
        <label><strong>Book title</strong>
          <input type="text" name="booktitle" placeholder="enter book title" value="<?php echo $_GET['title'];?>" >
        </label>

  <select name="booklist" id="booklist">  
 <!-- <option>Select a book</option>    -->   
       </select>
      
  <div class="clearfix">

<span class="like float-left">
        <i class="fa fa-thumbs-up fa-5x" aria-hidden="true" onclick="Remove()"></i></span>

<span class="dislike float-right">
        <i class="fa fa-thumbs-down fa-5x" aria-hidden="true" onclick="Remove()"></i></span>
        </div>

       
             
        <button type="submit" name="submit" id="submit"  onClick="saveRatings()" value="description" class="button expanded" style="background-color:#824CAF;">Submit</button>
      </div>
    </div>
  </div>
</form>

</div>

</div>
  </div>



<!--
  <tr>

    <td><?php echo $row['id'] ?></td>
    <td><?php echo $row['name']?></td>
    <td> <div class="ratings" data-rating="<?php echo $ratings;?>"></div></td>
    <td><?php echo $row['comments'] ?></td>
  </tr> -->

  <script>

 function load_data(query)
 {
  $.ajax({
   url:"fetchbooktitleslist.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#booklist').html(data);
   }
  });
 }
</script>

<script>
// var like = '';

  $('.like').click(function(event){
        
        event.preventDefault();
        var like = 1;
    alert(like);
   
});

var dislike = [];

 $('.dislike').click(function(event){
        
        event.preventDefault();
    alert('dislike');
    
});

</script>

<!--
  <script>

var ratings = 0;
$(function () {
    $(".starrr").starrr().on("starrr:change", function (event, value) {
        // alert(value);
        ratings = value;
    });

    var rating = document.getElementsByClassName("ratings");
    for (var a = 0; a < rating.length; a++)
    {
        $(rating[a]).starrr({
            readOnly: true,
            rating: rating[a].getAttribute("data-rating")
        });
    }
});

function saveRatings(form) {
    var product_id = form.product_id.value;
    var comments = form.comments.value;
    var name = form.name.value;
    var address = form.address.value;
    var mobile = form.mobile.value;


    $.ajax({
        url: "save-ratings.php",
        method: "POST",
        data: {
            "product_id": product_id,
            "ratings": ratings,
            "comments": comments,
            "name": name,
            "address": address,
            "mobile": mobile,

        },
        success: function (response) {
            alert(response);
            location.reload(form);
        }
    });

    return false;
}
     </script> -->
  </body>
  </html>
