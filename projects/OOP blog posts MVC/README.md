MVC
====
1. Model - data - fetching, inserting into database. Model updates the view
2. View - user interface - templates, html
3. controller - directs traffic e.g button click triggers controller to load to a page, save to database etc. Controller manipulates the model e.g fetching data
from database

File structure
===============
Set up NMP for PHP in visual studio code
In the directory create a folder for the project and add the following files:

config.php
index.php

Classes folder:
Bootstrap.php
Controller.php
Model.php

controllers folder:
home.php
shares.php
users.php

Models folder:
home.php

Views folder:
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

