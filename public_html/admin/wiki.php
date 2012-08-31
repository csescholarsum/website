<?php

include("config.php");
$indirection = "../";
include("./admin_top.php");
include ("../top.php");
include("adminMenu.php"); 
?>
<h3>CSE Scholars Officer Wiki</h3> <br />
Each officer posts information pertaining to their duties on their individual pages: <br /><br />
<a href="viewwiki.php?page=president">President</a><br />
<a href="viewwiki.php?page=vice_president">Vice President</a><br />
<a href="viewwiki.php?page=secretary">Secretary</a><br />
<a href="viewwiki.php?page=treasurer">Treasurer</a><br />
<a href="viewwiki.php?page=corporate_relations">Corporate Relations</a><br />
<a href="viewwiki.php?page=social_relations">Social Relations</a><br />
<a href="viewwiki.php?page=community_service">Community Service</a><br />
<a href="viewwiki.php?page=webmaster">Webmaster</a><br />
<?php
include ("../side.php");
include ("../bottom.php");
?>
