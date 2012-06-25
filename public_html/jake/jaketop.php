<?php
function curPageName() {
 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}

$curPage = curpageName();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Envision Optometry</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>


	<div id="nonfooter">
	<div id="page-wrap">
    	<div id="header" onclick="parent.location='envisionhome.php'"></div>
          		
    		<ul id="nav">
            	<li id="aboutus" <?php if ($curPage == "aboutus.php") echo "class=\"current\""; ?> ><a href="aboutus.php" title="About Us">About Us</a></li>
                <li id="ourteam" <?php if ($curPage == "ourteam.php") echo " class=\"current\""; ?> ><a href="ourteam.php" title="Our Team">Our Team</a></li>
                <li id="ourservices" <?php if ($curPage == "ourservices.php") echo " class=\"current\""; ?> ><a href="ourservices.php" title="Our Services">Our Services</a></li>
                <li id="contactus" <?php if ($curPage == "contactus.php") echo " class=\"current\""; ?> ><a href="contactus.php" title="Contact Us">Contact Us</a></li>
            </ul>
           
    			



<div id="imagesbar">
	<img src="images/imagesbar.png" />
    </div>
 
<?php
	if($curPage != "form.php")
	echo "<a href=\"form.php\"><img src=\"images/request.png\" border=\"0\"></a>";
?>

 
<!-- start page -->

<div id="content">

