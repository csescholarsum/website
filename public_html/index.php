<?php

/*
Created by jsallans
6-27-2012
PURPOSE: website main page
*/

//Uncomment to test login on localhost
$_SESSION['USER_UNIQ'] = "jsallans";
$_SESSION['type'] = "Admin";


	include('init.php');

?>
<head>

	<script>

		//jQuery script to run on DOM load
		$(function() {

<?php
			//set default slide position
			if (isset($_GET['slide_page'])) {
				
				echo "TabbedContent.slideContent($('#". $_GET['slide_page'] ."'));
						var background = $('#". $_GET['slide_page'] ."').parent().find(\".moving_bg\");
						$(background).stop().animate({
							left: $('#". $_GET['slide_page'] ."').position()['left']
						}, {
							duration: 300
						});";
			}
?>


			$( ".button").button();


			//Message Enum
			/*var type_message = {"members":1, "calendar":2, "resources":3};
			Object.freeze(type_message);

			//Randomly generate welcome message
			var random_message = Math.floor(Math.random() * 3) + 1;

			if (random_message == type_message.members) {
				message_popup("Welcome to CSE Scholars.com", "Click here to view our member page.", 1, "");
			}
			else if (random_message == type_message.calendar) {
				message_popup("Welcome to CSE Scholars.com", "Click here to view our upcoming events.", 1, "");
			}
			else if (random_message == type_message.resources) {
				message_popup("Welcome to CSE Scholars.com", "Click here to view helpful programming resources.", 1, "");
			}
			*/


			$( "img.loader").load(function() {
				ajax_load('content/blog.php', this);
			});

		});

		//Load Pages via AJAX
		function ajax_load( url, obj) {

			$.ajax({
				type: "POST",
				url: url,
				success: function(text) {

					$(obj).parent().html(text);
				}
			});

		}

	</script>

	<link href='css/tabbedContent.css' rel='stylesheet' type='text/css' />
    <script src="js/tabbedContent.js" type="text/javascript"></script>

    <title>
    	CSE Scholars
    </title>
</head>

<div class='container'>

<div class='header'>

	<div class='title'>
		<h1>
			CSE Scholars
		</h1>
		<h4>
			University of Michigan
		</h4>
		<h5>
			Organization for computer science and computer engineering.
		</h5>
		<h5>

<?php

	if (isset($_SESSION['type'])) {
		
		echo "Welcome, " . $_SESSION['USER_UNIQ'] . "\n";
	}
	else {
?>			
			<a href="https://web.eecs.umich.edu/~cseschol/login/index.php">
				Login
			</a>
<?php
	}
?>

		</h5>
	</div>
	<div class='image'>
		<img src="images/header.jpg">
	</div>
</div>

<div class='tabbed_content'>


<?php 

//________________NOT LOGGED IN_________________
if (!isset($_SESSION['type']))
{ 
	include("tabbed_content/not_logged_in.php");
}
else if ($_SESSION['type'] == "Member")
{
	include("tabbed_content/member.php");
}
else if ($_SESSION['type'] == "Admin")
{
	include("tabbed_content/admin.php");
}

?>

</div>

<!-- popup used by ajax/polls.php -->
<div class='poll_popup'>
</div>

<!-- general popup to be used by any file -->
<!-- example can be viewed in ajax/profile.php -->
<div class='popup'>
</div>


<!-- sample things
	<div class='shell'>
		<h3>shell</h3>
		<p>content will go here. in nice format.</p>
	</div>
	<button class='button'>A button element</button>
-->
	<br />
<?php
	include('bottom.php');
?>