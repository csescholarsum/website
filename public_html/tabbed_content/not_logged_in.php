<?php

/*
CREATED BY: jsallans
DATE: 8-28-12
PURPOSE: to keep different types of users separate
*/
?>

	<!--menu-->
    <div class='tabs'>
        <div class='moving_bg'>
            &nbsp;
        </div>

		<span id='home' class='tab_item'>
            Home
        </span>
        <span id='about' class='tab_item'>
            About Us
        </span>
        <span id='blog' class='tab_item'>
            Blog
        </span>
        <span id='calendar' class='tab_item'>
        	Calendar
        </span>
        <span id='members' class='tab_item'>
        	Members
        </span>
        <span id='resources' class='tab_item'>
        	Resources
        </span>
        <span id='officers' class='tab_item'>
        	Officers
        </span>

    </div>
    <br />
    <!--<hr style='width: 960px' />-->

	<!--page contents--> 
    <div class='slide_content'>
        <div class='tabslider'>
 
            <!-- content goes here -->
            <ul class='home'>
<?php
					include('content/home.php');
?>			    
			</ul>
			<ul class='about'>
<?php
					include('content/about_us.php');
?>			    
			</ul>
			<ul class='blog' id='blog_tab_content'>
				<br />
				<img src="images/ajax-loader.gif" class='loader'> Loading...
<?php
					//include('content/blog.php');
?>		
			</ul>
			<ul class='calendar'>
<?php
					include('content/calendar.php');
?>	
			</ul>
			<ul class='members' id='members'>
<?php
					include('content/members.php');
?>	
			</ul>
			<ul class='resources'>
<?php

					include('content/resources.php');
?>	
			</ul>
			<ul class='officers'>
<?php
					include('content/contact.php');
?>	
			</ul>
 
        </div>
    </div>