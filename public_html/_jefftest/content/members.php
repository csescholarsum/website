<?php
include ("tools/functions.php");
include("tools/dbConnect.php");

#this is the main page for members
if (isset($_GET['page'])) {

  #a little confusing the first is the folder the 2nd a php file
    include("resume_book/". $_GET['page'].".php");

}
else {

    include("resume_book/index.php");

}

?>