<?php 
#Needed to change directory refencing for top.php
$indirection = "../../";
$curPage = "tools";

#navigation bar
include("../admin_top.php");
include ("../../top.php");

#make events with a form
include("make_event.php");

#show all events in a table
include("get_event.php");

#side nav and footer
include ("../../side.php");
include ("../../bottom.php");
?>
