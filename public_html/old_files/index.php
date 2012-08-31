<?php 

##################################################################################
# U-M CSE Scholars CMS Public Page
# 10/19/07 - first draft (peplin)
# 1/19/08 - beta release, all functions 90-100% debugged minus FAQ (peplin)
##################################################################################

session_start();
require_once ('connections/connection.php');
include ("includes/config.php"); # config file with variables (required)
include("includes/admin.php");

include ($topfile);

$sec = $_GET['sec'];
$un = $_GET['un'];


$bb_codes = array (
	# bold
	'[b]' => '<span style="font-weight:bold">', '[/b]' => '</span>',
	# italic
	'[i]' => '<span style="font-style:italic">', '[/i]' => '</span>',
	# underline
	'[u]' => '<span style="text-decoration:underline">', '[/u]' => '</span>',
	# center
	'[center]' => '<center>', '[/center]' => '</center>');

switch ($sec) {
	case contact :
		pagetitle('Contact - ');
		contact();
		break;
	case blog :
		pagetitle('Blog - ');
		blog();
		break;
	case calendar :
		pagetitle('Calendar - ');
		calendar();
		break;
	case app : 
		pagetitle('Application - ');
		app();
		break;
	case faq :
		pagetitle('Course FAQ - ');
		faq();
		break;
	case profiles :
		pagetitle('Student Profiles - ');
		if(isset($un))
			viewStudent($un);
		else
			viewStudentList();
		break;
	case profile : 
		if($_SESSION['security'] < 2)
			edit_profile();
		else
			noaccess();
		break;
	case service_ops :
		if($_SESSION['security'] < 2)
			viewServiceOpportunities();
		else
			noaccess();
		break;
	case resume :
		if($_SESSION['security'] < 2)		
			edit_resume($_SESSION['uniqname']);
		else
			noaccess();
		break;
	case service :
		if($_SESSION['security'] < 2){
			if(isset($un))
				edit_service($un);
			else
				edit_service($_SESSION['uniqname']);
		}
		else
			noaccess();
		break;
	case edit_about :
		if($_SESSION['security'] == 1)
			edit_about();
		else
			noaccess();
		break;
	case edit_officers :
		if($_SESSION['security'] == 1)
			edit_officers();
		else
			noaccess();
		break;
	case add_projects :
		if($_SESSION['security'] == 1)
			add_projects();
		else
			noaccess();
		break;
	case edit_fulllogs :
		if($_SESSION['security'] == 1)
			edit_fullServiceLog();
		else
			noaccess();
		break;
	case addmembers :
		if($_SESSION['security'] == 1)
			addMembers();
		else
			noaccess();
			break;
	case addrecruiters :
		if($_SESSION['security'] == 1)
			addRecruiters();
		else
			noaccess();
			break;
	case edit_faq : 
		if($_SESSION['security'] == 1)
			edit_faq();
		else
			noaccess();
		break;	
	case resumes :
		if($_SESSION['security'] >= 1)
			resumeList();
		else
			noaccess();
		break;
	case logout :
		session_unset();
		session_destroy(); 
		about();
		break;
	default :
		about();
		break;
}

include ($sidefile);
include ($botfile);

function bbcodify($text, $filespath) {
	// basic BBCode
	foreach ($GLOBALS['bb_codes'] as $search => $replace) {
		$text = str_replace($search, $replace, $text);
	}
	// BBCode that needs some work
	$text = eregi_replace("\\[url\\]www.([^\\[]*)\\[/url\\]", "<a href=\"http://www.\\1\" target=_blank>\\1</a>", $text);
	$text = eregi_replace("\\[url\\]([^\\[]*)\\[/url\\]", "<a href=\"\\1\" target=_blank>\\1</a>", $text);
	$text = eregi_replace("\\[url=([^\"]*)\\]([^\\[]*)\\[\\/url\\]", "<a href=\"\\1\" target=_	blank>\\2</a>", $text);
	$text = eregi_replace("\\[email\\]([^\\[]*)\\[/email\\]", "<a href=\"mailto:\\1\">\\1</a>", $text);
	$text = eregi_replace("\\[email=([^\\[]*)\\]([^\\[]*)\\[/email\\]", "<a href=\"mailto:\\1\">\\2</a>", $text);
	$text = eregi_replace("\\[img\\]([^\\[]*)\\[/img\\]", "<img src=\"".$filespath."\\1\" border=0>", $text);
	$text = eregi_replace("\\[img=([^\\[]*)\\]([^\\[]*)\\[/img\\]", "<img src=\"".$filespath."\\1\"><br><font size=\"1\">\\2</font>", $text);
	return $text;
}

function pagetitle($ptitle) {
	global $pagetitle;
	echo '</body><head><title>', $ptitle, $pagetitle, '</title></head><body>';
}

function blog() {
	echo "
	<!--<h3 style='position:relative;left:-275px;'><a href='http://csescholars.wordpress.com/'>Blog</a></h3>-->
	<iframe src='http://csescholars.wordpress.com/'
	width='800'
	height='580'
	scrolling='auto'
	frameborder='0'
	style='position:relative;left:-275px;'/>";
}

function calendar(){
	$calendar = "http://www.google.com/calendar/embed?src=csescholars-google%40umich.edu&amp;title=CSE%20Scholars&amp;wkst=1&amp;hl=en&amp;height=594";
 echo "
 <iframe src='$calendar' 
	   style=' border-width:1 ' 
	   width='640'
	   frameborder='0' 
	   height='600'
	   marginwidth='400'>
	  </iframe>";

}

function contact(){
	
	$query = mysql_query("SELECT position, students.uniqname, name, email, description 
				FROM leadership, students 
				WHERE students.uniqname = leadership.uniqname
				ORDER BY sort"); 
	//link student name to their profile, after login	
		//Show officer information - officer name links to their student profile
	//E-mail is the position email, not the personal email account
	echo "<div id=\"officers_table\">";
	while(list($position, $uniqname, $name, $email, $description) = mysql_fetch_row($query)){
		echo "<div class=\"officer\">
					<div class=\"position\">$position</div>
					<div class=\"name\"><a href=\"index.php?sec=profiles&un=$uniqname\">$name</a></div>					
					<div class=\"email\"><a href=\"mailto:$email\">$email</a></div>	
					<div class=\"description\">$description</div>	
				</div> ";
	}
	echo "</div>";

}

function about() {

	$query = mysql_query("SELECT * FROM about");
	list($description, $applinfo, $welcomeday, $freshmanday) = mysql_fetch_row($query);

	echo "<div>$description</div>";
	echo "<div>$welcomeday</div>";
	echo "<div>$freshmanday</div>"; 	

}

function app() {

	$query = mysql_query("SELECT * FROM about");
	list($description, $applinfo, $welcomeday, $freshmanday) = mysql_fetch_row($query);

	echo "<div>$applinfo</div>";

	
}

//TODO decide how we want this information displayed
function faq() {
	global $db;

}

function viewStudent($uniqname){
	
	$query = mysql_query("SELECT name, students.grad_year, majors.major_name, students.uniqname, resume.timestamp, leadership.position 
                                FROM majors, students 
                                LEFT JOIN resume 
                                ON students.uniqname = resume.uniqname 
                                LEFT JOIN leadership 
                                ON students.uniqname = leadership.uniqname 
                                WHERE students.uniqname = '$uniqname' && students.major_id = majors.id");
	list($name, $grad_year, $major, $uniqname, $timestamp, $position) = mysql_fetch_row($query);
	
	echo "<div class=\"profile\">";
	
	echo "<div class=\"label\">Name:</div><div class=\"value\">$name</div>";
	
	if($position != NULL)
		echo "<div class=\"label\">Position:</div><div class=\"value\">$position</div>";
		
	echo "<div class=\"label\">Expected Graduation Year:</div><div class=\"value\">$grad_year</div>";
	echo "<div class=\"label\">Major:</div><div class=\"value\">$major</div>";
	echo "<div class=\"label\">Email:</div><div class=\"value\"><a href=\"mailto:$uniqname@umich.edu\">$uniqname</a></div>";
	if($timestamp != "0000-00-00 00:00:00")
		echo "<div class=\"label\"><a href=\"resume/$uniqname.pdf\">Resume</a></div>";
		
	echo "</div>";
}

function viewStudentList(){
	
	$query = mysql_query("SELECT students.name, majors.major_name, students.uniqname, leadership.position, resume.timestamp
                                FROM majors,students 
                                LEFT JOIN leadership ON leadership.uniqname = students.uniqname 
                                LEFT JOIN resume ON resume.uniqname = students.uniqname 
                                WHERE majors.id = students.major_id ORDER BY name");

	echo '<table><tr><th>Name</th><th>Major</th><th>Position</th><th>Resume</th></tr>';
	
	while(list($name, $major_name, $uniqname, $position, $timestamp) = mysql_fetch_row($query)){
		echo "<tr>
			<td><a href=\"index.php?sec=profiles&un=$uniqname\">$name</a></td>
			<td>$major_name</td>
			<td>$position</td>
			<td>";

		if($timestamp != "0000-00-00 00:00:00")
			echo "<a href=\"resume/$uniqname.pdf\">Resume</a>";
		else
			echo 'Resume';

		echo '</td></tr>';
	}
						
	echo '</table>';
}

function viewServiceOpportunities(){
	if ($_POST['submit']) {
		$un = $_SESSION['uniqname'];
		$projectSidSignup = $_POST['projectSid'];
	
		$already_signed_up = mysql_query("Select * FROM Volunteers WHERE uniqname='$un' AND Project_SID='$projectSidSignup'");
		if(mysql_num_rows($already_signed_up) == 0){		
			mysql_query("INSERT INTO Volunteers (uniqname, Project_SID) VALUES ('$un', '$projectSidSignup')");

			echo "Signed up successfully.";
		} else
			echo "Already signed up.";
	} else if ($_POST['reset']) {
		$un = $_SESSION['uniqname'];
		$projectSidSignup = $_POST['projectSid'];
	
		mysql_query("DELETE FROM Volunteers WHERE uniqname='$un' AND Project_SID='$projectSidSignup'");

		echo "Successfully removed.";
	}
	echo "<script language=\"javascript\">
		  function toggleDiv(divid){
			if(document.getElementById(divid).style.display == 'none'){
			  document.getElementById(divid).style.display = 'block';
			}else{
			  document.getElementById(divid).style.display = 'none';
			}
		  }
		</script>";
		
	$query = mysql_query("SELECT Project_Name, Datetime, Location, Duration, Contact, Requested, Description, SID, locked
						 	FROM projects");
	
	echo "<ul>";
	while(list($name, $datetime, $location, $duration, $contact, $requested, $description, $projectSid, $locked) = mysql_fetch_row($query)){
		echo "<li>";
		echo "<a href=\"javascript:;\" onmousedown=\"toggleDiv('project$projectSid');\">$name</a><br />";
		echo "<div id=\"project$projectSid\" style=\"display:";
		if ($_POST['submit'] && $projectSidSignup == $projectSid)
			echo "block";
		else
			echo "none";
		echo ";border: 1px white dashed;padding:10px\">";
		echo "<h2>$name</h2>";
		echo "<table width=\"100%\">";
		echo "<tr><td>$datetime</td><td align=\"right\">$location</td></tr>";
		if($duration != "")
			echo "<tr><td align=\"center\" colspan=\"2\">Counts for $duration service hours</td></tr>";
		if($requested != "")
			echo "<tr><td align=\"center\" colspan=\"2\">$requested volunteers requested</td></tr>";
		echo "</table>";
		echo "<p>$description</p>";
		$uniqname_query = mysql_query("SELECT uniqname FROM Volunteers WHERE Project_SID = $projectSid");
		echo "<h3>Signed Up</h3>";
		echo "<ol>";	
		while(list($uniqname) = mysql_fetch_row($uniqname_query))
			echo "<li>$uniqname</li>";
		echo "</ol>";
		if(!$locked){
			echo "<form action=\"".$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']."\" method=post enctype=\"multipart/form-data\">";
			echo "<input type=\"hidden\" name=\"projectSid\" value=\"$projectSid\" />";
			echo "<INPUT type=\"submit\" name=\"submit\" value=\"Sign me up!\">";
			echo "<INPUT type=\"submit\" name=\"reset\" value=\"Remove me.\">";
			echo "</FORM>";
		}
		echo "</div>";
		echo "</li>";
	}
	echo "</ul>";	
					
}

?>


