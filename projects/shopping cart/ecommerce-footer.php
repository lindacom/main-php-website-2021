  <!--e commerce footer-->                        

          <div class="ecommerce-footer" style="background-color:#AF824C;">
  <div class="ecommerce-footer-links row">
    
    <!--COLUMN ONE--> 
    <div class="small-12 medium-12 large-6 columns">
      
      
      
      <div class="row ecommerce-footer-links-block">
       
       
        <div class="small-4 medium-4 large-4 columns">
          <h5>Categories</h5>

          <!--dynamic list of categories from books table--> 
          <ul class="menu vertical" id="dynamic_categories">
            
          </ul>
        </div>
       
              </div>

    </div>



    <!--COLUMN TWO--> 
    <div class="small-12 medium-12 large-6 columns">
     <div class="row">
       
       <div class="small-4 medium-4 large-4 columns">
        <h5>My Account</h5>
        <ul class="menu vertical">
          <li><a href="/books/shoppinglogin.php">Sign In</a></li>
        
          <li><a href="#">My orders</a></li>
                 </ul>
         
      </div>

      

      <div class="small-4 medium-4 large-4 columns">
        <h5>About</h5>
        <ul class="menu vertical">
           <li><a href="#">Orders</a></li>
          <li><a href="/books/contactus.php">Contact</a></li>
         
        </ul>
      </div>

      <div class="small-4 medium-4 large-4 columns">
        <h5>Social</h5>
        <ul class="menu vertical">
          <li><a href="#">Facebook</a></li>
          <li><a href="#">Twitter</a></li>
       
          <li><a href="#">Youtube</a></li>
        </ul>
      </div>

     </div>
    </div>
  </div>
 
  

 <section class="portfolio">					
 <a class="button" href="" target="_blank"><i class="fab fa-facebook-f"></i><span class="show-for-sr">Facebook page</span></a>
<a class="button" href="" target="_blank"><i class="large fab fa-twitter"></i><span class="show-for-sr">Twitter feed</span></a>
<a class="button" href="" target="_blank"><i class="large fab fa-youtube"></i><span class="show-for-sr">YouTube channel</span></a>
												
		</section>  
        
        
        </div>

         <script>
$(document).ready(function(){

load_categories(1)

    });

    function load_categories(page, query = '')
    {
      $.ajax({
        url:"fetchcategorieslist.php",
        method:"POST",
        data:{page:page, query:query},
        success:function(data)
        {
          $('#dynamic_categories').html(data);
        }
      });
    }
    </script> 
