<?php

include("config.php");
include("../functions.php");
$name = $user;
$fullName = GetFullName($name);
if ($fullName != "")
	$name = $fullName;

$page = $_GET['page'];
$pageName = str_replace("_", " ", $page);
$pageName = ucwords($pageName);

$emsg = "";

if (isset($_FILES['resourceFile']))
{
	$target_path = "wiki/$page/".$_FILES['resourceFile']['name'];
	move_uploaded_file($_FILES['resourceFile']['tmp_name'], $target_path);
	$emsg = "Uploaded resource: $target_path";
}

if (isset($_GET['del']))
{
	$del = "./wiki/$page/".$_GET['del'];
	if (file_exists($del))
		unlink($del);
	$emsg = "Deleted resource: $del";
}

if (isset($_POST['pageSource']))
{
	$file = "wiki/$page/source.php";
	$fh = fopen($file, 'w') or die("can't open file");
	$data = stripslashes($_POST['pageSource']);
	$edit_date = date("F j, Y");
	$edit_time = date("g:i A");
	$sig = "<!-- EDIT RECORD --><br /><br /><br />Last edited by $name on $edit_date at $edit_time";
	$data = $data.$sig;
	fwrite($fh, $data);
	fclose($fh);
	$emsg = "Edited source";
}

if ($emsg != "")
{
	$emsg = $emsg."\n".$page."\n".date("g:i A")." ".date("F j, Y");
	mail("jeffsallans@gmail.com", "Change to Wiki", $emsg);
}

$indirection = "../";
include("./admin_top.php");
include ("../top.php");
include("adminMenu.php"); 
?>
<br />
<h3 style="display: inline;"><?php echo $pageName; ?> Wiki</h3><a style="float: right" href="viewwiki.php?page=<?php echo $page; ?>">View Page</a><br /><br /><br />

<?php

$file = "wiki/$page/source.php";
if (!file_exists($file))
	echo "Error: This wiki does not exist";
else
{
?>

	<form enctype="multipart/form-data" name="resourceUpload" method="post" action="editwiki.php?page=<?php echo $page; ?>">
	Upload Resource: &nbsp;<input type="file" name="resourceFile"  /> &nbsp; <input type="submit" value="Upload" />
	</form><br /><br />
    
<?php

$fh = fopen($file, 'r');
$wikiSource = fread($fh, filesize($file));
$i = strrpos($wikiSource, "<!-- EDIT RECORD -->");
if ($i !== false)
	$wikiSource = substr($wikiSource, 0, $i);
fclose($fh);

?>

<form name="sourceForm" method="post" action="editwiki.php?page=<?php echo $page; ?>">
    <textarea name="pageSource" cols="50" rows="50"><?php echo $wikiSource; ?></textarea>
    <input type="submit" value="Update" />
</form>

<?php

}
$caller = "edit"; //lets side bar know to include delete option
include ("wiki_side_bar.php");
include ("../bottom.php");
?>
