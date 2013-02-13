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
        <span id='members' class='tab_item'>
        	Members
        </span>
        <span id='resources' class='tab_item'>
        	Resources
        </span>
        <span id='officers' class='tab_item'>
        	Officers
        </span>
        <span class='login_button'>
<?php

    if (isset($_SESSION['type'])) {
        
        echo "Welcome, " . $_SESSION['USER_UNIQ'] . "\n";
    }
    else {
?>          
            Login
            <script type="text/javascript">
                $(function() {
                    $('.login_button').click(function() {
                        window.location.href = 'https://web.eecs.umich.edu/~cseschol/login/index.php';
                    });
                });
            </script>
<?php
    }
?>
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