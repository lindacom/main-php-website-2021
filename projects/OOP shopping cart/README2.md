         
 JQuery
 =======
 
  window redirect
  ----------------
 window.location.href = "http://example.com/shopping/shopfront.php?name=" + encodeURIComponent(txt);
 
 click event prompt box
 ----------------------
 ```
 <script>
$(document).ready(function(){
  $("#cart").click(function(){
   // alert("The paragraph was clicked.");

    var txt;
  var person = prompt("Please enter your name:", "linda");
  if (person == null || person == "") {
    txt = "User cancelled the prompt.";
  } else {
      txt = person;
    window.location.href = "http://lindacom.infinityfreeapp.com/shopping/shopfront.php?name=" + encodeURIComponent(txt);
  }
  });
});
</script>
```
