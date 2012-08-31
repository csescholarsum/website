<?php


?>

<script type="text/javascript">

	$(function() {
		$( "#my_profile_tabs" ).tabs({
			ajaxOptions: {
				type: "POST",
				success: function() {
					TabbedContent.slideContent($('#my_profile'));
				},
				error: function( xhr, status, index, anchor ) {
					$( anchor.hash ).html("Couldn't load this tab.");
				}
			}
		});

	});

</script>

<style type="text/css">
	#my_profile_tabs .ui-tabs-nav {
		width: 100%;
		overflow: hidden;
		padding: 0px;
	}
</style>

<br />

<div id="my_profile_tabs">
	<ul>
		<li><a href="#welcome">Welcome</a></li>
		<li><a href="ajax/current_members.php">Profile</a></li>
		<li><a href="ajax/prospective_members.php">Polls</a></li>
	</ul>

	<div id="welcome">
		<br />
		<p>Welcome <?php echo $_SESSION['USER_UNIQ']; ?></p>
	</div>
</div>