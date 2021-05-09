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


Routes
========

index file:
In the index file require the bootstrap class file and the config.php file and controller class file and controllers - home.php, shares.php and users.php
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
The base Model class is an abstract class that other classes extend from. it contains PDO for database connection
constants are conained in the config file - database parameters that don't change.

