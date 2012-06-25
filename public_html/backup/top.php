<?php if (!isset($curPage)) $curPage = "index"; ?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="generator" content="Bluefish 1.0.7">
<link href="<?php if ($indirection == 1) echo "../"; ?>style.css" rel="stylesheet" type="text/css">
<title><?php if (isset($pageTitle)) echo $pageTitle; else echo "CSE Scholars: University of Michigan"; ?></title>
<?php if (isset($includeStyle)) include($includeStyle); ?>

</head>

<body>
<div id="header">
	<div id="logo">
		<h1><a href="<?php if ($indirection == 1) echo "../"; ?>index.php">&lt;cse.scholars&gt;</a></h1>
		<h2>University of Michigan</h2>
	</div>



	<div id="menu">
	        <div id="about">
	                <ul>
					 	<li<?php if ($curPage == "index") echo " class=\"first\""; ?>><a href="<?php if ($indirection == 1) echo "../"; ?>index.php">About CSE Scholars</a></li>
						<li<?php if ($curPage == "blog") echo " class=\"first\""; ?>><a href="<?php if ($indirection == 1) echo "../"; ?>blog.php">Blog</a></li>
					 	<li<?php if ($curPage == "calendar") echo " class=\"first\""; ?>><a href="<?php if ($indirection == 1) echo "../"; ?>calendar.php">Calendar</a></li>
					 	<li<?php if ($curPage == "contact") echo " class=\"first\""; ?>><a href="<?php if ($indirection == 1) echo "../"; ?>contact.php">Contact</a></li>
						<li<?php if ($curPage == "join") echo " class=\"first\""; ?>><a href="<?php if ($indirection == 1) echo "../"; ?>join.php">Join CSE Scholars</a></li>
					 	<li><a href="http://www.eecs.umich.edu/LearningCenter/">EECS Learning Center</a></li>
						<li<?php if ($curPage == "members") echo " class=\"first\""; ?>><a href="<?php if ($indirection == 1) echo "../"; ?>members.php">Member List</a></li>
					</ul>
	        </div>
	</div>


</div>

<!-- start page -->
<div id="page">
<div id="content">
