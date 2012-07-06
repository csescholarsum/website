<?php

/*
Created by jsallans
6-27-2012
PURPOSE: website main page
*/

	include('init.php');

?>
<head>

	<script>

		//jQuery script to run on DOM load
		$(function() {
			$( ".button").button();


			//Message Enum
			var type_message = {"members":1, "calendar":2, "resources":3};
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

		});

	</script>

	<link href='css/tabbedContent.css' rel='stylesheet' type='text/css' />
    <script src="js/tabbedContent.js" type="text/javascript"></script>
</head>

<div class='container'>

<div class='tabbed_content'>
    <div class='tabs'>
        <div class='moving_bg'>
            &nbsp;
        </div>
        <span class='tab_item'>
            Home
        </span>
        <span class='tab_item'>
            Blog
        </span>
        <span class='tab_item'>
        	Calendar
        </span>
        <span class='tab_item'>
        	Resources
        </span>
    </div>
 
    <div class='slide_content'>
        <div class='tabslider'>
 
            <!-- content goes here -->
			<ul>
<?php
					include('content/home.php');
?>			    
			</ul>
			<ul>
<?php
					include('content/blog.php');
?>		
			</ul>
			<ul>
<?php
					include('content/calendar.php');
?>	
			</ul>
			<ul>
<?php
					include('content/resources.php');
?>	
			</ul>
 
        </div>
    </div>
</div>
	<div class='shell'>
		<h3>shell</h3>
		<p>content will go here. in nice format.</p>
	</div>
	<button class='button'>A button element</button>
	
	<br />
<?php
	include('bottom.php');
?>