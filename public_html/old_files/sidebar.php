</div>
	<!-- start sidebar -->
	<div id="sidebar">
		<ul>
			<li>
				<h2>Member Pages</h2>
			<?			
			
$valid_user = 0;
if (!isset ($_SESSION['uniqname']) || !isset ($_SESSION['password'])) {
	echo $login_form_header;	
	echo $login_form;
}
else{ //check provided name
	$uniqname = $_SESSION['uniqname'];

	$sql = mysql_query("SELECT security, password FROM students WHERE uniqname = '$uniqname'");

	$fetch_em = mysql_fetch_array($sql);
	if (md5($_SESSION["password"]) == $fetch_em["password"]) {
		$valid_user = 1;
		$_SESSION['security'] = $fetch_em['security'];

	} else {
		$valid_user = 0;
	}
// If the name exists and pass is correct, don't pop up the login code again.
// If info can't be found or verified....try again

if (!($valid_user)) {
	session_unset();
	session_destroy(); 
	
	echo "<p>Incorrect login information, please try again.</p>";
		
	echo $login_form_header;	
	echo $login_form;			
}
else {
	?>
				<ul>

               <?php
							show_memberfuncs();
							
					?>
					               
				</ul>
	
	<!--<li><a href="admin.php?sec=minutes">Meeting Minutes</a></li>
   <li><a href="index.php?sec=groups">Working Groups</a></li> -->
	<?
	}
	}
	
		
		?>
                			</li>
		</ul>
	</div>           
