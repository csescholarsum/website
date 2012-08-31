<?php
if (!isset($curpage)) $curpage = "index";
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="generator" content="Bluefish 1.0.7">
<link href="style.css" rel="stylesheet" type="text/css">
<title><?php if (isset($pageTitle)) echo $pageTitle; else echo "588 Connections: University of Michigan"; ?></title>
<?php if (isset($includeStyle)) include($includeStyle); ?>

</head>

<body>
<div id="header">
	<div id="logo">
		<h1><a href="index.php">&lt;588 Connections&gt;</a></h1>
		<h2>University of Michigan</h2>
	</div>



	<div id="menu">
	        <div id="about">
	                <ul>
					 	<li<?php if ($curpage == "index") echo " class=\"first\""; ?>><a href="index.php">588 Connections</a></li>
						<li<?php if ($curpage == "mail") echo " class=\"first\""; ?>><a href="mail.php">Mail</a></li>
                        <li<?php if ($curpage == "photos") echo " class=\"first\""; ?>><a href="photos.php">Photos</a></li>
                        <li<?php if ($curpage == "about") echo " class=\"first\""; ?>><a href="about.php">About</a></li>
					</ul>
	        </div>
	</div>


</div>

<!-- start page -->
<div id="page">
<div id="content">
