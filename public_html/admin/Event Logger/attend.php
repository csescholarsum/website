<?php 
#Needed to change directory refencing for top.php
$indirection = "../../";

#navigation bar
include("../admin_top.php");
include ("../../top.php");

#make events with a form
include("add_to_attend.php");

#show all events in a table
include("get_attend.php");

#side nav and footer
include ("../../side.php");
include ("../../bottom.php");
?>
