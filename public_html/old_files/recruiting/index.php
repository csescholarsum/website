<?php   

##################################################################################
# U-M CSE Scholars CMS Recruiter Page
# 10/19/07 - first draft (peplin)
# 1/19/08 - beta release, all functions 90-100% debugged minus FAQ (peplin)
##################################################################################

session_start();
include ("../config.php"); // config file with variables

$login_form_header = "<form action=\"".$_SERVER['PHP_SELF'];
		
	if($_SERVER['QUERY_STRING']){ 
		$login_form_header .= '?'. $_SERVER['QUERY_STRING']; 
	}	

	$login_form_header .= "\" method=\"POST\">";
		
	
	$login_form = "
			<table>
			    <input type=\"Hidden\" name=\"loggedin\" value=\"yes\">
			    <tr><th>Email:</th><td><input type=\"text\" name=\"email\"></td></tr>
			    <tr><th>CSE Scholars Password:</th><td><input type=\"password\" name=\"password\"></td></tr>
			    <tr><td colspan=\"2\"><input type=\"submit\" value=\"Login\"></td></tr>
			</table>
			</form>";
	
		

// Checks to make sure the user is logged in every time the page loads
$db = mysql_connect("localhost", $sqluser, $sqlpass);
if (!$db) {
	echo '<p>Error connecting to database!</p>';
	exit;
}
mysql_select_db($sqldb, $db);

if ($_POST['email'] && $_POST['password']) {
	session_register("email");	
	session_register("password");
	
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['password'] = $_POST['password'];
}

if (!isset ($_SESSION['email']) || !isset ($_SESSION['password'])) {
	echo "<p>You must be logged in to access the recruiter panel.</p>";
	showheader();
	
		echo $login_form_header;	
		echo $login_form;
			
		echo "</body></html>";
	exit();
}

// Here you would check the supplied name and password against your database to see if they exist.

$email = $_SESSION['email'];

$sql = mysql_query("SELECT password FROM recruiters WHERE email = '$email'");

$fetch_em = mysql_fetch_array($sql);
if (md5($_SESSION["password"]) == $fetch_em["password"]) {
	$valid_user = 1;
} else {
	$valid_user = 0;
}



// If the name exists and pass is correct, don't pop up the login code again.
// If info can't be found or verified....

if (!($valid_user)) {
	session_unset();
	session_destroy(); 
	showheader();
	
	echo "<p>Incorrect login information, please try again.</p>";
			
	echo $login_form_header;	
	echo $login_form;			
	
	echo  "</body></html>";
			
	exit ();
}

showheader();

$run = $_GET['run'];

switch ($run) {
	
	case logout :
		session_unset();
		session_destroy(); 
		umsg("Logged Out.", "", "");
		break;
	default :
		resumeList();
		break;
	}



function  resumeList(){
	$query = mysql_query("SELECT students.name, students.uniqname
											FROM students, resume
											WHERE students.uniqname = resume.uniqname
											AND resume.timestamp !=  \"0000-00-00 00:00:00\"");

	echo '<table><tr><td colspan=\"2\"><a href=\"../resume/cse-resumes.zip\">Resume Package (Compressed Zip File)</a></td></tr><tr><th>Name</th><th>Resume (PDF)</th></tr>';
	
	while(list($name, $uniqname) = mysql_fetch_row($query))
		echo "<tr>
			<td><a href=\"../index.php?sec=profiles&un=$uniqname\">$name</a></td>
			<td><a href=\"../resume/$uniqname.pdf\">Download</a></td></tr>";
						
	echo '</table>';
}

function showheader() {

	echo "<html><head><title>U-M CSE Scholars Recruiting Panel</title>";
	echo '<link href="../styles/recruiting.css" rel="stylesheet" type="text/css">';

   echo "</head><body>";
	echo "<ul>";
	
	if ($_SESSION['name'])
		echo '<li> <a href="index.php?run=logout">Logout</a></li>';
		
	echo "</ul>";
						                 
}

function umsg($s, $u, $m) {
	echo '<center><b>', $s, '<p><p><a href="', $u, '">', $m, '</a></center>';
}

?>
