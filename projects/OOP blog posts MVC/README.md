MVC
====
Model - data - fetching, inserting into database. Model updates the view
View - user interface - templates, html
controller - directs traffic e.g button click triggers controller to load to a page, save to database etc. Controller manipulates the model e.g fetching data
from database

File structure
===============
Set up NMP for PHP in visual studio code
In the directory create a folder for the project and add the following files:

config.php
index.php

Classes folder:
Bootstrap.php


Routes
========

index file:
In the index file require the bootstrap class file and the config.php file
Create a new instance of the bootstrap object and pass in the get parameter as the request

Bootstrap file:
In the classes/Bootstrap.php file there are variables for the request, action and controller properties
The constructor takes in the request and checks whether there is a controller and an action in the url.

