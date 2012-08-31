<?php


?>

<script type="text/javascript">

	$(function() {
		$( "#tabs" ).tabs({
			disabled: [1, 2, 3, 4],
			ajaxOptions: {
				type: "POST",
				success: function() {
					TabbedContent.slideContent($('#members'));
					oTable = $(".date_table").dataTable({
						"bDestroy": true,
						"iDisplayLength": 50,
						"aLengthMenu": [[25, 50, -1], [25, 50, "All"]]
					});
				},
				error: function( xhr, status, index, anchor ) {
					$( anchor.hash ).html("Couldn't load this tab.");
				}
			}
		});

		$(".submit_email_button").click(function() {

			$.ajax({
				type: "POST",
				url: "<?php echo $_SESSION['base_url']; ?>ajax/action/save_email_of_visitor.php",
				data: { email : $('.submit_email_text').val() },
				success: function(text) {

					//Check if the process was sucessful
					if (text.indexOf("success") != -1) {

						//Change selected and remove disabled tabs
						$("#tabs").tabs( "option", "disabled", false );
						$("#tabs").tabs({ selected: 1 });
						$("#tabs").tabs( "option", "disabled", [0] );

						message_popup("", text, -1, "#");
					}
					else {

						message_popup("Error", text, -1, "#");
					}
				}
			});
		});

	});

</script>

<style type="text/css">
	#tabs .ui-tabs-nav {
		width: 100%;
		overflow: hidden;
		padding: 0px;
	}
</style>

<br />

<div id="tabs">
	<ul>
		<li><a href="#submit_email">Submit Email</a></li>
		<li><a href="ajax/current_members.php">Current Members</a></li>
		<li><a href="ajax/prospective_members.php">Prospective Members</a></li>
		<li><a href="ajax/resume_book.php">Resume Book</a></li>
		<li><a href="ajax/alumni.php">Alumni</a></li>
	</ul>

	<div id="submit_email">
		<br />
		<p>
			Please provide your email to view our members database and resume book.  
			<br />
			Your email address will never be shared with a third party.
		</p>
		Email: <input type='text' class='submit_email_text' />
		<button class='submit_email_button'>
			Submit
		</button>
	</div>
</div>