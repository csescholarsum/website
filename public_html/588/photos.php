<?php 
include("dbConnect.php");
if (!$loggedin)
{
	header('Location: index.php');
	exit();
}

if (isset($_FILES['photoFile']))
{
	if (strlen($_FILES['photoFile']['name']) < 5)
		$target_path = "uploads/".rand().$_FILES['photoFile']['name'];
	else
		$target_path = "uploads/".rand().substr($_FILES['photoFile']['name'], 5);
	
	move_uploaded_file($_FILES['photoFile']['tmp_name'], $target_path);

}

$curpage = "photos";
include ("top.php");
?>

<h3>Photos</h3>

<form enctype="multipart/form-data" name="photoResume" method="post" action="photos.php">
	Upload Photo: &nbsp;<input type="file" name="photoFile"  /> &nbsp; <input type="submit" value="Upload" />
</form><br /><br />

<?php

//show all photos

if ($handle = opendir('./uploads'))
{
    while (false !== ($file = readdir($handle)))
    {
		if (($file != ".")&&($file != ".."))
			echo "<img src=\"uploads/$file\"/>\n";
	}
    closedir($handle);
}


include ("side.php");
include ("bottom.php");
?>


