<?php


$username = $password = "";
$usernameErr = $passwordErr = "";


// if($_SERVER["REQUEST_METHOD"] == "POST") { 


    if(isset($_POST["Login"])) {
  if (empty($_POST["txtuser"])) {
    $usernameErr = "Name is required";
  } else {
    $username = test_input($_POST["txtuser"]);
     // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["txtpass"])) {
    $passwordErr = "password is required";
  } else {
    $password = test_input($_POST["txtpass"]);
     // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$password)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  $username = $_POST['txtuser']; //txtuser is the name in the form field
$password = $_POST['txtpass']; //txtpass is the name in the form field
    
    $checkuser = "SELECT * FROM tbl_customer WHERE CustomerName ='$username' AND password ='$password' ";
 
 $run = mysqli_query($connect, $checkuser);



if (mysqli_num_rows($run)>0) {

    // doesn't allow user to access if expired date in database

    while($row = mysqli_fetch_array($run))
 {
   $expiry = new DateTime($row['expiry']);
 }
 
  if (new DateTime() <= $expiry) {
      session_start();
    //set the session with the name user_name 
    $_SESSION['customer'] = $username;

         // setting session start and expire times 10 minutes - Nb. instead of setting session to true it has been set to time
         //    $_SESSION["customer"] = true;
         $_SESSION['start'] = time(); // Taking now logged in time.
            // Ending a session in 30 minutes from the starting time.
            $_SESSION['expire'] = $_SESSION['start'] + (10 * 60);
         
   }  else {
       echo "sorry your subscription has expired on " . $expiry->format('F J, Y') ;
   }
  

     
if(isset($username)) {

        $url = $_SESSION['customerloggedin'];
         $queryb = parse_url($url, PHP_URL_QUERY);
    
   
    if ($queryb) {
        $url .= "&customer=" .$_SESSION['customer']; //if url already has parameters add & username to the end
    } else {
        $url .= "?customer=" .$_SESSION['customer'];
    }
       
          header('Location:'.$url); 
          
        } else {
            header('Location: http://example.com/books/myaccount.php?username=' .$_SESSION['customer']);
 
      }

      if(!isset($_SESSION['customerloggedin'])) {
 header('Location: http://example.com/books/myaccount.php?username=' .$_SESSION['customer']);
      }



//the header location takes the user to my homepage on successful login.  you can change this to the page you want them to go to in your website
}
else{
echo "Username and/or password do not match! Try again!";
}


}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  checktheuser($data);
}



?>


















 
 




