MVC
====
1. Model - data - fetching, inserting into database. Model updates the view
2. View - user interface - templates, html
3. controller - directs traffic e.g button click triggers controller to load to a page, save to database etc. Controller manipulates the model e.g fetching data
from database

File structure
===============

In the directory add the following files:

config.php
index.php

Classes folder:
----------------
Bootstrap.php
Controller.php
Model.php
Messages.php

controllers folder:
-----------------------
home.php
shares.php
users.php

Models folder:
-------------
home.php

Views folder:
----------------
main.php


Routes
========

index file:
In the index file require the bootstrap class file, controllers class file and model class file 
require the config.php file 
require controller class file 
require controllers - home.php, shares.php and users.php
require models - home.php, share.php and user.php

Create a new instance of the bootstrap object and pass in the get parameter as the request

call the create controller method
calls the exeute action method


Bootstrap file:
In the classes/Bootstrap.php file there are variables for the request, action and controller properties
The constructor takes in the request and checks whether there is a controller and an action in the url and then looks for the controller class.

Controllers
===============
The controller class is an abstract class that other classes extend from.

The home controller extends the controller class

Model
=====
The base Model class is an abstract class that other classes extend from. it contains PDO for database connection, query method and bind function, execute
function and results function
N.b. constants are conained in the config file - database parameters that don't change.

The home model

The user and share models contain queries.

Create database
---------------
Create database and tables 
users - id, name varchar 255, email, password, registered date date/time current timestamp
shares - id auto increent, primary, user id int, title, body text, link, create date date time current timestamp

Make a query and get data
------------------------

The shares controller creates a new Sharemodel object
the share model extends the base Model class. It contains and index funtion with a query

Views
=====
shares model is quryig dataase and displaying array in the viw

main.php

Login and authentication
==========================

Controller
-----------
users controller has register method which refers to user model to create a new model and returns view
users controller also has a login method
users controller has a logout method which unsets sessions and destroys the session and redirects to root url

Model
-----
user model has register method and a login method

Views
-------
Register:
views > users > register.php contains a form to be competed by user, inserts details into database 
register view returns the login view after form submission.

Login:
login view contains a login form which checks user details in the database.  

Sessions:
In the user model if the login details are correct a logged in session is set to true, 
a session data session is set to an array containing id and name and email from the database. It then redirects to the shares view.

Access control
===============
Restrict access to certain pages

hide button if not logged in:

```
<?php if(isset($_SESSION)) : ?> 
    <a class="btn btn-success btn-share" href="<?php echo ROOT_PATH; ?>>shares</a> 
    <?php endif; ?>
```

If no logged in then redirect otherwise show the view:

```
  protected function add() {
if(!isset($_SESSION['is_logged_in'])) {
    header('Location: '.ROOT_URL. 'shares');
}
                $viewmodel = new ShareModel();
        $this->ReturnView($viewmodel->add(), true);
    }
}
```

Message class
============
Alows you to neatly display messages instead of having to echo them out on the page. Can be used to display error message, success message, validation

1. Create a message class
sets a session thn if session set display message then unsets the message
error messages
success messages

2. include the message class in the index file
3. set the message class in the model file. N.b the messages class is static so you dont need to instantiate it you can just call set message meethod passing in
message and type (error or success) as parameters

example one:
```
else {
                  Messages::setMsg('Incorrect Login', 'error');
              }
```
example two:
```
// if fields are blank display error message
        if ($post['name'] == '' || $post['email'] == '' || $post['password'] == '' ) {
            Messages::setMsg('Please fill in all fields', 'error');
            return; // stops running
          }
```

4. display the message in the main view 

```
<?php Messages::display(); ?>
```

