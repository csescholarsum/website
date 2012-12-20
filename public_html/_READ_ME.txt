CSE Scholars Website Overview
Last Updated: December 20th, 2012
----------------------------------------------------
Current Webmaster: Jeff Sallans (jsallans@umich.edu)
Previous Webmaster: James Priestly
----------------------------------------------------

Software Need:
wamp/lamp/mamp

http://www.wampserver.com/en/
Cywin (for windows)
    http://cygwin.com/install.html
git
    http://git-scm.com/downloads
   

Software Recommended:
Sublime Text 2 (text editor)
    http://www.sublimetext.com/2
MySQL workbench (large volume sql table backup)
    http://www.mysql.com/products/workbench/
Github for Windows (helps learns git)
    http://windows.github.com/

Tutorials:
git
    http://rogerdudler.github.com/git-guide/
    http://stackoverflow.com/questions/1960799/using-gitdropbox-together-effectively
    http://www.gitguys.com/topics/merging-with-a-conflict-conflicts-and-resolutions/

Background:
php
javascript
html
css
    www.w3schools.com
jquery
    www.jquery.com
jquery-ui
    www.jqueryui.com
   
Contacts:
Jeff Sallans
    jeffsallans@gmail.com
    (810) 240-1345
CAEN Server help
    Office on  the 2nd Floor of BBB

Laura Fink
        laura@eecs.umich.edu
   
Server: web.eecs.umich.edu
username: cseschol
password: Cs3_sch0L (Keep very confidential)

Database
access through: eecs.umich.edu/phpmyadmin (Has to be a CAEN computer)
username: cseschol
password: JAwNuTrJ.

One of the first things that we should probably do is make a backup of
the website and the database.
I would make an old git branch of the current website.
(SSH on the server)
>> ssh cseschol@web.eecs.umich.edu
>> git checkout -b <name of new branch>

How to get a local copy of the website:
(go to www directory)
>> git clone cseschol@web.eecs.umich.edu:~/.git

How to get a local copy of the database:
Use PHP My Admin and export a .sql file on the CAEN Machine.
Import the .sql file with wamp on your local Machine
    if the size is too large use MySQL Workbench

How to update the website:
Open 2 Terminals
(in cse_scholars_test directory)
1>> git commit -a -m “<message>”
2>> ssh cseschol@web.eecs.umich.edu
2>> git commit -a -m “<message>”
1>> git pull
2>> git checkout <temp branch>
1>> git push
2>> git checkout master

Website Design:

    resumes need to saved under the html folder

    login directory has an .htaccess setup with cosign and will redirect to home and store a session cookie
    Content for the tabs are saved under content
    ajax folder has all ajax (.php) files
    contact Jeff if there are more questions