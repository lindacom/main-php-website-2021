To start a new project using live server
============================================

Create a folder on the desktop
In visual studio code go to termina > new terminal
navigate to the new folder using the cd command

Go to visual studio code extensions
Search for and install live server. N.b. live server has to be started from the index page. Live server automatically updates the page in the browser.
search for and install auto close tag

Add files to the project
------------------------
N.b. typing doc and pressing the tab key creates an html document template in viual studio code

Open the project
-----------------
Press shift + ctrl + P and type live server: open live server 
go to the browser to view the file.

To start a new project 
=========================

Create a folder on the desktop
In visual studio code go to termina > new terminal
navigate to the new folder using the cd command

At the command line enter:
1. npm init - to create the package.json file. Follow the steps to enter all its properties
2. npm install <packagename> - (if required) to install a package and save it as a dependency in the package.json file This will also to create the package-lock.json file
3. Install nodemon to watch for changes to files and automatically update server.  From the command lin enter npm install -g nodemon
  
In visual studio code open the folder (file > open folder)
1. Create a server.js file and copy template code into this file (see online examples). 
2. at the command line enter node server.js to start the server
  
Open the browser and go to the local host name to view the app on the local server
  
To start a project using node-static
=====================================
follow the instructions above and install node static - npm install node-static
  
write the following code in the server.js file
  
```
  var static = require('node-static');
var http = require('http');

var file = new(static.Server)(__dirname);

http.createServer(function (req, res) {
  file.serve(req, res);
}).listen(3000);
  ```
