<?php
include ("functions.php");
include("dbConnect.php");
$curPage="members";
include("top.php"); 


#this is the main page for members
if (isset($_GET['resume_book'])) {

  #a little confusing the first is the folder the 2nd a php file
    include("./resume_book/resume_book.php");

}
else {

    include("./resume_book/index.php");

}

include ("side.php");
include("bottom.php");
?>