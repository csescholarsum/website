<?php

/*
Created by jsallans
6-22-12

Overview:
This is an auto message sender to specific users in onyx.
Similar to outlooks message alert.
This will run every 5 min in the background by default to check for an attention.
This number can be adjusted by passing a variable.

Required:
config_jquery.php is to be already included
   for the jquery tags
$_SESSION['mute'] is set to determine audio

How To Use:
call message_popup(user_id, message, refresh, time_on)

	title   | the title displayed in the popup
	message | the string/html to be displayed in the popup
	time_on | the number of minutes the message should stay on screen 
	[if a negative number then the message won't leave the screen]
*/

?>

<script type="text/javascript">

	var time;

//_________________jQuery________________

	jQuery(function() {

		//comment out by jsallans
		//6-28-12
		//would load after message popup was intially called
		//jQuery('#message_popup').hide();

		jQuery('#message_popup_close button').click(message_popup_remove);
		
		jQuery('#message_popup_close button').mouseover(function(){

			//highlight close button on click
			jQuery('#message_popup_close button').addClass('ui-state-hover');
		});

		jQuery('#message_popup_close button').mouseout(function(){

			//highlight close button on click
			jQuery('#message_popup_close button').removeClass('ui-state-hover');
		});

	});


	function message_popup( title, message, time_on, link) {

		if (link != '' && link != '#') {

			jQuery( "#message_popup .link").attr('href', link);
			jQuery( "#message_popup .link").attr('target', '_blank');
		}
		else {

			jQuery( "#message_popup .link").removeAttr('href');
			jQuery( "#message_popup .link").removeAttr('target');
		}

		jQuery( "#message_popup .message").html(message);

		jQuery( "#message_popup .title").html(title);

		jQuery( "#message_popup .message").html(message);

		jQuery( "#message_popup" ).show( 'slide', { direction: "down" } , 500);

		//play sound
<?php
	//music will only play if mute is off
	if ( isset($_SESSION['mute']) && $_SESSION['mute'] == 0) {

		echo "document.getElementById('message_popup_sound').play();";
	}
?>


		//Check if user set not to disappear
		if (time_on >= 0) {

			time = setTimeout("message_popup_remove();", time_on * 60000);
		}

	}

	function message_popup_remove() {

		jQuery( "#message_popup" ).hide( 'slide', { direction: "down" } , 500);

		clearTimeout(time);
	}


</script>


<style type="text/css">

	#message_popup {

		background-color: #FFFFFF;
		position: fixed;
		z-index: 80;
		right: 0px;
		bottom: 0px;
		width: 400px;
	}

	#message_popup div {

		size: 12pt;
	}

	#message_popup div.message {

		text-align: left;
	}


	#message_popup_close {

		/*this is a right align fix for the close button*/
		display: inline;
		position: absolute;
		right: 15px;
	}

	#message_popup .ui-widget-content {

		margin-bottom: 50px;
	}

	#message_popup .message {

		padding: 8px;
	}

	#message_popup .ui-widget-header {

		padding: 5px 0px 15px 0px;
		margin: 0px 0px 5px 0px;
	}

	#message_popup a {
		/* Applies to all unvisited links */
		text-decoration:  none;
	} 

</style>

<div id="message_popup" style='display: none;' class='ui-corner-all'>
	<h3 class="ui-widget-header ui-corner-all">
		&nbsp;
		<span class="title">
		</span> 
		<div id='message_popup_close'>
			<button class='ui-corner-all ui-state-default'>
				<span class='ui-icon ui-icon-closethick'></span>
			</button>
		</div>
	</h3>
	<a target="_blank" class='link' href="#">
		<div class="ui-widget-content ui-corner-all">
			<div class='message'>
				Etiam libero neque, luctus a, eleifend nec, semper at, lorem. Sed pede. Nulla lorem metus, adipiscing ut, luctus sed, hendrerit vitae, mi.
			</div>
			<br />
			<br />
		</div>
	</a>
</div>
<audio id='message_popup_sound'>
	<source src="audio/exclamation.ogg"></source>
</audio>

