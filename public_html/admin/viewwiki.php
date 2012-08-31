<?php

include("config.php");

$page = $_GET['page'];
$pageName = str_replace("_", " ", $page);
$pageName = ucwords($pageName);

$indirection = "../";
include("./admin_top.php");
include ("../top.php");
include("adminMenu.php"); 
?>
<br />
<h3 style="display: inline;"><?php echo $pageName; ?> Wiki</h3><a style="float: right" href="editwiki.php?page=<?php echo $page; ?>">Edit Page</a><br /><br /><br />

<?php

$file = "wiki/$page/source.php";
if (!file_exists($file))
	echo "Error: This wiki does not exist";
else
{
	include($file);
}
include ("wiki_side_bar.php");
include ("../bottom.php");
?>
