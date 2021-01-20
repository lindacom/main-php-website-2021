<?php
// session_start();

$errors = [];
if (isset($_POST['Signup'])) {
    include '../books/includes/db_connect.php';
    $expected = ['username', 'pwd', 'confirm'];
    // Assign $_POST variables to simple variables and check all fields have values
    foreach ($_POST as $key => $value) {
        if (in_array($key, $expected)) {
            $$key = trim($value);
            if (empty($$key)) {
                $errors[$key] = 'This field requires a value.';
            }
        }
    }
    // Proceed only if there are no errors
    if (!$errors) {
        if ($pwd != $confirm) {
            $errors['nomatch'] = 'Passwords do not match.';
        } else {
            // Check that the username hasn't already been registered
            $sql = 'SELECT COUNT(*) FROM tbl_customer WHERE CustomerName = :username';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            if ($stmt->fetchColumn() != 0) {
                $errors['failed'] = "$username is already registered. Choose another name.";
            } else {
                try {
                   // Generate a random 8-character user key and insert values into the database
                    $user_key = hash('crc32', microtime(true) . mt_rand() . $username);
                
                    $sql = 'INSERT INTO tbl_customer (user_key, CustomerName, password)  
                            VALUES (:key, :username, :password )';
                    
                    $stmt = $db->prepare($sql);              
                  
                   
                  $stmt->bindParam(':key', $user_key);
                   $stmt->bindParam( ':username', $username);
                    // Store an encrypted version of the password
                  $stmt->bindValue(':password', password_hash($pwd, PASSWORD_DEFAULT));

                                    $stmt->execute();

                           
                } catch (\PDOException $e) {
                    if (0 === strpos($e->getCode(), '23')) {
                        // If the user key is a duplicate, regenerate, and execute INSERT statement again
                        $user_key = hash('crc32', microtime(true) . mt_rand() . $username);
                        if (!$stmt->execute()) {
                            throw $e;
                        }
                    }
                }
                // The rowCount() method returns 1 if the record is inserted,
                // so redirect the user to the login page
                if ($stmt->rowCount()) {
                  //  session_start();
                           $_SESSION['customer'] = $username;
                           

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
                  //  exit;
                }
            }
        }
    }
}
?>
