<?php 
include("dbConnect.php");
if (!$loggedin)
{
	header('Location: index.php');
	exit();
}
$curpage = "about";
include ("top_scan.php");
?>
<h3>About</h3>

<p>
This is a fake social networking site. It was built to demonstrate a variety of web-based attacks on websites. If you choose to hack this site, please do not cause permanent damage.
</p>

<?php
include ("side.php");
include ("bottom.php");
?>


