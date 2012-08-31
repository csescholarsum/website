<?php

$_SESSION['USER_UNIQ'] = $_REQUEST['USER_UNIQ'];

include ("../tools/functions.php");

connect_to_db();
?>

<br />
<br />

<?php
$query = mysql_query("SELECT * FROM polls");

if (mysql_num_rows($query) == 0)
{
	echo "There are no open polls at this time.\n\n";
}
else
{
?>
<table>
	<tr>
    	<td>Name</td>
        <td>Description</td>
        <td>Voting Open</td>
    </tr>
<?php
	while ($pollData = mysql_fetch_row($query))
	{
		list($pid, $poll_name, $description, $visible, $open, $writein) = $pollData;
		if (!$visible)
			continue;
		if ($open)
			$open = "Open";
		else
			$open = "Closed";
		if ($poll_name == "")
			$poll_name = "No Name";
		echo "\t<tr class='view_poll_row'>\n";
		echo "\t<input type='hidden' value='$pid'>\n";
		echo "\t\t<td>$poll_name</td>\n";
		echo "\t\t<td>$description</td>\n";
		echo "\t\t<td>$open</td>\n";
		echo "\t</tr>\n";
	}
}
?>
</table>

<script type="text/javascript">

	$(function () {
		
		$(".poll_popup").dialog({
			autoOpen: false,
			modal: true,
			show: "fade",
			hide: "fade",
			width: "600px",
			buttons: {
				"Vote" : function() {
					$(".voteForm").submit();
				},
				"Close" : function() {
					$(this).dialog('close');
				}
			}
		})

		$(".view_poll_row").click(function() {

			$.ajax({
				type: "POST",
				url: "ajax/view_poll.php",
				data: { USER_UNIQ : '<?php echo $_SESSION['USER_UNIQ']; ?>', id : $(this).children().val()},
				success: function(text) {

					$(".poll_popup").dialog('open');
					$(".poll_popup").html(text);
				}
			});
		});

		$(".voteForm").live("submit", function() {
			$.ajax({
				type: "POST",
				url: "ajax/action/save_vote.php",
				data: $(".voteForm").serializeArray(),
				success: function(text) {

					message_popup("", text, 1, "#");

					$(".poll_popup").dialog("close");

					$.ajax({
						type: "POST",
						url: "ajax/view_poll.php",
						data: { USER_UNIQ : '<?php echo $_SESSION['USER_UNIQ']; ?>', id : $(".voteForm .poll_id").val()},
						success: function(text) {

							$(".poll_popup").dialog('open');
							$(".poll_popup").html(text);
						}
					});

					//Another ajax to print poll results
					//print_poll_results($(".voteForm .poll_id").val(), ".poll_results");
				}
			});

			//Returning false overrides the page reload.
			return false;
		});
	});

	function print_poll_results( poll_id, selector) {

		alert(poll_id);

		$.ajax({
			type: "POST",
			url: "ajax/action/print_poll_result.php",
			data: { poll_id : poll_id},
			success: function(text) {

				$(selector).html(text);
			}
		});
	}

</script>

<style type="text/css">

	.view_poll_row:hover {

		cursor: pointer;
		background-color: #E0E0EF;
	}

	.view_poll_row:active {

		cursor: pointer;
		background-color: #D0D0DF;
	}

</style>