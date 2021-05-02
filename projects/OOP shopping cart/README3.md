Grid container
==============

<div class="grid-container"></div>

Search box
================
```
        <div class="sbox">
        <h3 style="font-family: 'Train+One', serif;">Quick search</h3>
          <div class="form-group ">
            <input type="text" name="search_box" id="search_box" class="form-control" placeholder="Search by title, author or category" role="search">
          </div>
          <p class="text-right"><a href="http://lindacom.infinityfreeapp.com/books/librarysearchfull.php" style="color:white">Full search</a></p>
        </div>
 ```
        
       

Bordered table
===============
```
    <div class="table-responsive">
   <table class="table table bordered">
        <tr>
    <th>ID</th>
    <th>Book Title</th>
    <th>Category</th>
     <th>Price</th>     
     <th>Purchase</th>
  </tr>
  ```
        
Button
=========
```
echo '<div class="float-right"><a href="http://lindacom.infinityfreeapp.com/shopping/mycart.php" target="_blank">
<button class="success button" type="button" style="background-color:#38803E;font-size:19px;">Continue to Basket > </button></a></div>';
```

On click display input box and change url to include name entered
=====================================================================

```
<script>
 $(document).ready(function(){
  $("#payment").click(function(){
  
    var txt;
  var person = prompt("Please enter your name:", "linda");
  if (person == null || person == "") {
    txt = "User cancelled the prompt.";
  } else {
      txt = person;
     
    window.location.href = "http://lindacom.infinityfreeapp.com/shopping/payment.php?name=" + encodeURIComponent(txt);
  }
  });
 });
</script>
```
    
