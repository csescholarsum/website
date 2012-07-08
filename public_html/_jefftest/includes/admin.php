<?php

##################################################################################
# U-M CSE Scholars CMS
# 10/19/07 - first draft (peplin)
# 1/19/08 - beta release, all functions 90-100% debugged minus FAQ (peplin)
##################################################################################

$login_form_header = "<form action=\"".$_SERVER['PHP_SELF'];
		
	if($_SERVER['QUERY_STRING']){ 
		$login_form_header .= '?'. $_SERVER['QUERY_STRING']; 
	}	

	$login_form_header .= "\" method=\"POST\">";
		
	$login_form = "
			<table>
			    <input type=\"Hidden\" name=\"loggedin\" value=\"yes\">
			    <tr><th>Uniqname:</th><td><input type=\"text\" name=\"uniqname\"></td></tr>
			    <tr><th>CSE Password:</th><td><input type=\"password\" name=\"password\"></td></tr>
			    <tr><td colspan=\"2\"><input type=\"submit\" value=\"Login\"></td></tr>
			</table>
			</form>";

function edit_about() {
	
	if ($_POST['submit']) {
	
	$description = $_POST['description'];
	$applinfo = $_POST['applinfo'];
	$welcomeday = $_POST['welcomeday'];
	$freshmanday = $_POST['freshmanday'];
	
	mysql_query("UPDATE about set description = '$description', applinfo = '$applinfo', welcomeday = '$welcomeday', freshmanday = '$freshmanday'");
	
	echo "General CSE Scholars information updated successfully.";
	
	} 

		$query = mysql_query("SELECT * FROM about");
		list($description, $applinfo, $welcomeday, $freshmanday) = mysql_fetch_row($query);

		echo "<form action=\"".$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']."\" method=post enctype=\"multipart/form-data\">
<div class=\"row\"><span class=\"label\">Description: </span><span class=\"input\"><textarea name=\"description\">$description</textarea></span>
</div>
<div class=\"row\"><span class=\"label\">Application Info: </span><span
class=\"input\"><textarea name=\"applinfo\">$applinfo</textarea></span></div>
		<div class=\"row\"><span class=\"label\">Welcome Day: </span><span
class=\"input\"><textarea name=\"welcomeday\">$welcomeday</textarea></span></div>
		<div class=\"row\"><span class=\"label\">Freshman Day: </span><span
class=\"input\"><textarea name=\"freshmanday\">$freshmanday</textarea></span></div>
		<div class=\"submit\"><input type=\"submit\" name=\"submit\" value=\"Submit\"></div></form>";

}

function edit_profile() {
	$un = $_SESSION['uniqname'];
	if ($_POST['submit']) {
	
	$name = $_POST['name'];
	$grad_year = $_POST['grad_year'];
	$major_id = $_POST['majors'];
	$password = $_POST['password'];
	$password_confirm = $_POST['password_confirm'];
	
	if($password == $password_confirm){
	
	mysql_query("UPDATE students SET name = '$name', grad_year = '$grad_year', major_id = '$major_id' WHERE uniqname = '$un'");
	
	if($_POST['password'] != ""){
		$new_hash = md5($password);
		mysql_query("UPDATE students set password = '$new_hash' WHERE uniqname = '$un'");
	}
	
	echo "<p>Student profile updated successfully.</p>";
	}
	else
		echo "The password did not match - try again.";
	} 
		$query = mysql_query("SELECT * FROM students, majors WHERE uniqname = '$un' && majors.id = students.major_id");
		list($name, $grad_year, $major_id, $un, $password, $security, $id, $major_name) = mysql_fetch_row($query);
	
		echo "
<form action=\"".$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']."\" method=post enctype=\"multipart/form-data\">
<input type=\"hidden\" name=\"old_hash\" value=\"$password\">
<div class=\"row\">
<span class=\"label\">Name:</span><span class=\"input\"><input name=\"name\" type=\"text\" value=\"$name\"></span>
</div>
<div class=\"row\"><span class=\"label\">Expected Graduation Year:</span><span class=\"input\"><input name=\"grad_year\" type=\"text\" value=\"$grad_year\"></span>
</div>
		<div class=\"row\"><span class=\"label\">Major: </span><span
class=\"input\">".selectMajors($major_id)."</span></div>
		<div class=\"row\"><span class=\"label\">New Password:</span><span
class=\"input\"><input type=\"password\" name=\"password\"></span></div>
<div class=\"row\"><span class=\"label\">Confirm New Password:</span><span
class=\"input\"><input type=\"password\" name=\"password_confirm\"></span></div>
		<div class=\"submit\"><input type=\"submit\" name=\"submit\" value=\"Submit\"></div></form>";
}

function edit_resume($uniqname) {
	
	if ($_POST['submit']) {
				//actually upload resume, and only do the following if successful
				uploadfiles();
	
				//updates timestamp in db
				mysql_query("UPDATE resume set uniqname = 'uploading' WHERE uniqname = '$uniqname'");
				mysql_query("UPDATE resume set uniqname = '$uniqname' WHERE uniqname = 'uploading'");
				
				echo "Resume uploaded successfully.";
	} 
		echo "
<form action=\"".$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']."\" method=post enctype=\"multipart/form-data\">
Select your resume file (PDF): <input name=\"uploaded\" type=\"file\" /><br />
<input type=\"submit\" name=\"submit\" value=\"Upload\" />
</form>";
}

function addMembers() {
	if ($_POST['submit']) {
		if($_POST['name0'] != ""){
		$names = "('".$_POST['name0']."')";
			for($i = 1; $i < 20 && $_POST['name'.$i] != ""; $i++)
				$names .= ", ('".$_POST['name'.$i]."')";
			$names .= "";
			mysql_query("INSERT INTO students (uniqname) VALUES ".$names);
			mysql_query("INSERT INTO resume (uniqname) VALUES ".$names);		
		}
		else
			echo "You must insert at least one uniqname.";
		echo "<p>CSE Scholars members added successfully. Please have them login and update their profile. Their password is \"changeme\"</p>";
	} 
		echo "
<form action=\"".$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']."\" method=post enctype=\"multipart/form-data\">
Uniqnames<br />";

for($i = 0; $i < 20; $i++)
	echo "<input type=\"text\" name=\"name".$i."\"><br />";

echo "<input type=\"submit\" name=\"submit\" value=\"Add\" />
</form>";
}

function addRecruiters() {
	if ($_POST['submit']) {
		if($_POST['email0'] != ""){
		$emails = "('".$_POST['email0']."')";
			for($i = 1; $i < 20 && $_POST['email'.$i] != ""; $i++)
				$emails .= ", ('".$_POST['email'.$i]."')";
			$emails .= "";
			mysql_query("INSERT INTO recruiters (email) VALUES ".$emails);		
		}
		else
			echo "You must insert at least one email.";
		echo "CSE Scholars corporate recruiter added successfully. Their password is \"cse08\" and they should login at /recruiting";
	} 
		echo "
<form action=\"".$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']."\" method=post enctype=\"multipart/form-data\">
Emails<br />";

for($i = 0; $i < 20; $i++)
	echo "<input type=\"text\" name=\"email".$i."\"><br />";

echo "<input type=\"submit\" name=\"submit\" value=\"Add\" />
</form>";
}

//TODO set manual date, don't update date when i make a slight change
function edit_service($uniqname) {
	//if($_POST['uniqname'])
	//	$uniqname = $_POST['uniqname'];

	if ($_POST['submit']) {


	$query = mysql_query("SELECT service_log.id FROM service_log
																						  WHERE uniqname = '$uniqname' ORDER BY id");

	while(list($id) = mysql_fetch_row($query)){ //TODO this could be streamlined so every entry isn't updated each time
	
				if($_POST['delete_'.$id] == on)
					mysql_query("DELETE FROM service_log WHERE uniqname = '$uniqname' AND id = '$id'");
				else{
					$category_id = $_POST['categories_'.$id];
					$description = $_POST['description_'.$id];
					$hours = $_POST['hours_'.$id];
					
						mysql_query("UPDATE service_log 
																		SET category_id = '$category_id', description = '$description', hours = '$hours' 
																		WHERE uniqname = '$uniqname' AND id = '$id'");
					}
		}
		if($_POST['hours_new'] != ""){
	
		$category_id = $_POST['categories_new'];
					$description = $_POST['description_new'];
					$hours = $_POST['hours_new'];
					mysql_query("INSERT INTO service_log (uniqname, category_id, description, hours) 
																		VALUES ('$uniqname', '$category_id', '$description', '$hours')");
		}
	echo "Service log updated successfully.";
	}

	echo "<h1>$uniqname</h1>";
	//display table top
	echo "<form action=\"".$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']."\" method=post enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"uniqname\" value=\"$uniqname\"><table>
			<tr><th>Date</th><th>Category</th><th>Description</th><th>Hours</th><th>Delete?</th></tr>";
	
	//display new entry line
	echo "
	<tr>
	<td></td>
	<td><span class=\"input\">".selectServiceCategory()."</span></td>
	<td><span class=\"input\"><input type=\"text\" name=\"description_new\"></span></td>
	<td><span class=\"input\"><input type=\"text\" name=\"hours_new\"></span></td>
	<td></td>
	</tr>";
	
	$query = mysql_query("SELECT service_log.id, timestamp, uniqname, category_id, description, hours, category_name FROM service_log, service_cat 
																						  WHERE uniqname = '$uniqname' AND service_log.category_id = service_cat.id ORDER BY timestamp DESC");

	while(list($id, $timestamp, $un, $category_id, $description, $hours, $category_name) = mysql_fetch_row($query))
			echo "<tr>
			<td>$timestamp</td>
			<td><span class=\"input\">".selectServiceCategory($category_id, $id)."</span></td>
			<td><span class=\"input\"><input type=\"text\" name=\"description_$id\" value=\"$description\"></span></td>
			<td><span class=\"input\"><input type=\"text\" name=\"hours_$id\" value=\"$hours\"></span></td>
			<td><input type=\"checkbox\" name=\"delete_$id\"></td>
			</tr>";

	$query = mysql_query("SELECT SUM(service_log.hours) AS sum FROM service_log WHERE service_log.uniqname = '$uniqname' GROUP BY uniqname");
	list($sum) = mysql_fetch_row($query);
	
	echo "<tr><td></td><td></td><td></td><td><b>Total: </b>$sum</td></tr>";
	
	//display table bottom
	echo "</table>
	<div class=\"submit\"><input type=\"submit\" name=\"submit\" value=\"Save\"></form></div>";
}

function edit_officers() {
	if ($_POST['submit']) {
		
		$uniqname = $_POST['uniqnames'];
		$email = $_POST['email'];
		$description = $_POST['description'];
		$position = $_POST['position'];
	
		mysql_query("UPDATE leadership SET uniqname = '$uniqname', email = '$email', description = '$description' WHERE position = '$position'");

		echo "Officer updated successfully.";
	}

	$query = mysql_query("SELECT position FROM leadership ORDER BY sort");
	$position = $_GET['pos'];
	echo "<p>";
		while(list($pos) = mysql_fetch_row($query))
				echo "<div><a href=\"index.php?sec=edit_officers&pos=$pos\">$pos</a></div>";
	echo "</p>";
	
	if($position){
		$query = mysql_query("SELECT * FROM leadership WHERE position = '$position'");
		list($position, $uniqname, $email, $description, $sort) = mysql_fetch_row($query);
	
		echo "<form action=\"".$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']."\" method=post enctype=\"multipart/form-data\"><input type=\"hidden\" name=\"position\" value=\"$position\">
<div class=\"row\">Position: $position</div>
<div class=\"row\">
<span class=\"label\">Student:</span><span class=\"input\">".selectStudents($uniqname)."</span>
</div>
<div class=\"row\"><span class=\"label\">Email:</span><span class=\"input\"><input name=\"email\" type=\"text\" value=\"$email\"></span>
</div>
		<div class=\"row\"><span class=\"label\">Description: </span><span
class=\"input\"><textarea name=\"description\">$description</textarea></span></div>
		<div class=\"submit\"><input type=\"submit\" name=\"submit\" value=\"Submit\"></div></form>";

	}
		

	}
	
function add_projects() {
	if ($_POST['submit']) {
		
		$name = $_POST['name'];
		$location = $_POST['location'];
		$description = $_POST['description'];
		$datetime = $_POST['datetime'];
		$duration = $_POST['duration'];
		$contact = $_POST['contact'];
		$requested = $_POST['requested'];	
		
		
		mysql_query("INSERT INTO projects (project_name, location, description, datetime, duration, contact, requested) VALUES
										   ('$name', '$location', '$description', '$datetime', '$duration', '$contact', '$requested')");

		echo "Project added successfully.";
	}

	echo "<form action=\"".$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']."\" method=post enctype=\"multipart/form-data\">";
	echo "<LABEL for=\"name\">Name</LABEL><br /><input type=\"text\" style='width:400px;' name=\"name\" value=\"\"><br />";
	echo "<LABEL for=\"location\">Location</LABEL><br /><input type=\"text\" style='width:400px;' name=\"location\" value=\"\"><br />";
	echo "<LABEL for=\"description\">Description</LABEL><br /><textarea rows=\"5\" style='width:400px;' name=\"description\" value=\"\" ></textarea><br />";
	echo "<LABEL for=\"datetime\">Datetime</LABEL><br /><input type=\"date\" style='width:400px;' name=\"datetime\" value=\"\"><br />";
	echo "<LABEL for=\"duration\">Duration</LABEL><br /><input type=\"text\" style='width:400px;' name=\"duration\" value=\"\"><br />";
	echo "<LABEL for=\"contact\">Contact</LABEL><br /><input type=\"float\" style='width:400px;' name=\"contact\" value=\"\"><br />";
	echo "<LABEL for=\"requested\">Requested</LABEL><br /><input type=\"integer\" style='width:400px;' name=\"requested\" value=\"\"><br />";
	echo "<input type=\"submit\" name=\"submit\" value=\"Submit\">";
	echo "</form>";

	
		

}

function  edit_fullServiceLog(){
	$query = mysql_query("SELECT students.name, students.uniqname, SUM(service_log.hours)
											FROM students, service_log
											WHERE students.uniqname = service_log.uniqname
											GROUP BY students.uniqname");

	echo '<table><tr><th>Name</th><th>Total Hours</th></tr>';
	
	while(list($name, $uniqname, $hours) = mysql_fetch_row($query))
		echo "<tr>
			<td><a href=\"index.php?sec=service&un=$uniqname\">$name</a></td>
			<td>$hours</td></tr>";
						
	echo '</table>';
}

function  resumeList(){
	$query = mysql_query("SELECT students.name, students.uniqname
											FROM students, resume
											WHERE students.uniqname = resume.uniqname AND resume.timestamp != '0000-00-00 00:00:00'");

	echo '<table><tr><th>Name</th><th>Resume PDF</th></tr>';
	
	while(list($name, $uniqname) = mysql_fetch_row($query))
		echo "<tr>
			<td><a href=\"index.php?sec=profiles&un=$uniqname\">$name</a></td>
			<td><a href=\"resumes/$uniqname.pdf\">Download</a></td></tr>";
						
	echo '</table>';
}

function selectServiceCategory($category_id = -1, $id = 0){
	
	$query =  mysql_query("SELECT * FROM service_cat ORDER BY category_name");
	
	if($category_id == -1)
		$output = "<select name=\"categories_new\">";
	else
		$output = "<select name=\"categories_$id\">";
	
	while(list($id, $name) = mysql_fetch_row($query)){
		$output .= "<option value=\"$id\"";
		if($id == $category_id)
			$output .= " selected";
		$output .= ">$name";
	}
	
	$output .= "</select>";
	
	return $output;
}

function selectMajors($majorID){
	
	$query =  mysql_query("SELECT * FROM majors ORDER BY major_name");
	
	$output = "<select name=\"majors\">";	
	while(list($id, $name) = mysql_fetch_row($query)){
		$output .= "<option value=\"$id\"";
		if($id == $majorID)
			$output .= " selected";
		$output .= ">$name";
	}
	
	$output .= '</select>';
	
	return $output;
}
	
function selectStudents($un){
	
	$query =  mysql_query("SELECT uniqname FROM students ORDER BY uniqname");
	
	$output = "<select name=\"uniqnames\">";	
        $output .= "<option value=\"\">";
	while(list($uniqname) = mysql_fetch_row($query)){
		$output .= "<option value=\"$uniqname\"";
		if($uniqname == $un)
			$output .= " selected";
		$output .= ">$uniqname";
	}
	
	$output .= '</select>';
	
	return $output;
}

function uploadfiles() {
	global $HTTP_POST_FILES, $ulpath;
	$uniqname = $_SESSION['uniqname'];
	$error = 0;
	
	$name = $HTTP_POST_FILES['uploaded']['name']; // this is the real name of your file
	$tmp = $HTTP_POST_FILES['uploaded']['tmp_name']; // this is the temporary name of your file in temporary
	
	// directory on the server
	if (!is_uploaded_file($tmp)) // is this temporary file really uploaded?
		echo "Resume not uploaded";

	$ext = strtolower(".".end(explode('.', $name)));
	
	if($ext == ".pdf") {
		$ulpath = $ulpath.'/'.$uniqname.".pdf";

		if (!@ move_uploaded_file($tmp, $ulpath))
			$error = 1;
	}
	else{
		$error = 1;
		echo "<span class=Error>Please use a PDF of your resume.</span><br>";	            		 
	}

	//Check for problems		 
	if (strlen($name) == 0) {
			echo "<span class=Warning>Select at least one file to upload.</span>";
			return false;
	} else if ($error){
			echo "<span class=Error>The file has not been uploaded.</span><br>";	            		 
			return false;
	}
	
	return $name;
}

function show_memberfuncs() {


	if ($_SESSION['uniqname'] && $_SESSION['security'] < 2){
		echo '<li> <a href="index.php?sec=profile">Your Profile</a></li><li> <a href="index.php?sec=service">Service Log</a></li><li> <a href="index.php?sec=resume">Resume</a></li>';
		echo '<li> <a href="index.php?sec=service_ops">Service Opportunities</a></li>';
	}

	if($_SESSION['uniqname'] && $_SESSION['security'] == 1)
		echo'	<li><a href="index.php?sec=edit_about">General CSE Information</a></li><li> <a href="index.php?sec=edit_officers">Officers</a></li><li> <a href="index.php?sec=addmembers">Add Members</a></li><li> <a href="index.php?sec=addrecruiters">Add Recruiters</a></li><li> <a href="index.php?sec=edit_fulllogs">All Service Logs</a></li>';
		echo "<li><a href=\"index.php?sec=add_projects\">Add Projects</a></li>";
		//<li> <a href="index.php?sec=edit_faq">Course Guide & FAQ</a></li>
	if($_SESSION['uniqname'] && $_SESSION['security'] >= 1)
		echo "<li><a href=\"index.php?sec=resumes\">Full Resume List</a></li>";	
	
	if ($_SESSION['uniqname'])
		echo '<li> <a href="index.php?sec=logout">Logout</a></li>';   
						                 
}

function noaccess() {
	echo 'You do not have access to that function! <br />';
}

?>
