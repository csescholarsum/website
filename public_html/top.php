<?php
if (!isset($noStats))
{
if (!isset($indirection)) $indirection = "./";
if (!isset($menu_extra)) $menu_extra = "";
if ($indirection == 1) include("../admin/statHelper.php"); else include("admin/statHelper.php");
} 
if (!isset($curPage)) $curPage = "index"; ?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="generator" content="Bluefish 1.0.7">
<link href="<?php echo $indirection; ?>style.css" rel="stylesheet" type="text/css">
<title><?php if (isset($pageTitle)) echo $pageTitle; else echo "CSE Scholars: University of Michigan"; ?></title>
<?php if (isset($includeStyle)) include($includeStyle); ?>

</head>

<body>
<div id="header">
	<div id="logo">
		<h1><a href="<?php echo $indirection; ?>index.php">&lt;cse.scholars&gt;</a></h1>
		<h2>University of Michigan</h2>
	</div>



	<div id="menu">
	        <div id="about">
	                <ul>
					 	<li<?php if ($curPage == "index") echo " class=\"first\""; ?>><a href="<?php echo $indirection; ?>index.php">About CSE Scholars</a></li>
						<li<?php if ($curPage == "blog") echo " class=\"first\""; ?>><a href="<?php echo $indirection; ?>blog.php">Blog</a></li>
					 	<li<?php if ($curPage == "calendar") echo " class=\"first\""; ?>><a href="<?php echo $indirection; ?>calendar.php">Calendar</a></li>
					 	<li><a href="http://www.eecs.umich.edu/LearningCenter/" target="_blank" >Tutoring</a></li>
					 	<li><a href="http://web.eecs.umich.edu/~cseschol/apscholars_website/website" target="_blank" >AP CompSci</a></li>					 	
                        <li<?php if ($curPage == "polls") echo " class=\"first\""; ?>><a href="<?php echo $indirection; ?>polls.php">Polls</a></li>
						<li<?php if ($curPage == "members") echo " class=\"first\""; ?>><a href="<?php echo $indirection; ?>members.php">Member List</a></li>
                        <li<?php if ($curPage == "resources") echo " class=\"first\""; ?>><a href="<?php echo $indirection; ?>resources.php">Resources</a></li>
                        <li<?php if ($curPage == "contact") echo " class=\"first\""; ?>><a href="<?php echo $indirection; ?>contact.php">Contact</a></li>
						<?php echo $menu_extra; ?>
					</ul>
	        </div>
	</div>


</div>

<!-- start page -->
<div id="page">
<div id="content">
