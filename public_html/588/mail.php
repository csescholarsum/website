<?php 
include("dbConnect.php");
if (!$loggedin)
{
	header('Location: index.php');
	exit();
}

$msg = date(DATE_RFC822, time())."\n".$_SERVER['HTTP_REFERER'];
//mail("priestley92@gmail.com", "hit", $msg);

if (isset($_POST['toU']))
{
	$to = $_POST['toU'];
	$date = time();
	$msg = $_POST['msg'];
	$q = ("INSERT INTO 588mail (toU, fromU, from_name, message, time) VALUES ('$to', '$user', '$name', '$msg', '$date')");
	mysql_query($q);
}

if (isset($_GET['del']))
{
	$del = $_GET['del'];
	//not secure
	if ($del == "*")
		mysql_query("DELETE FROM 588mail");
	else
	{
		$q = "DELETE FROM 588mail WHERE id = $del";
		mysql_query($q);
		$q .= "<br />".mysql_errno().": ".mysql_error();
	}
}

$curpage = "mail";
include ("top.php");
?>

<h3>Mail</h3>

<?php //echo $q."<br /><br />"; //remove
	//show all messages
	$query = mysql_query("SELECT * FROM 588mail WHERE toU = '$user'");
	if (mysql_num_rows($query) == 0)
		echo "You have no messages<br /><br />\n\n";
	else
	{
		$num = mysql_num_rows($query);
		if ($num == 1)
			echo "You have 1 new message<br /><br />\n\n";
		else
			echo "You have $num new messages<br /><br />\n\n";
		echo "<table><th>&nbsp;</th><th>&nbsp;</th><th>From</th><th>&nbsp;</th><th>Message</th><th>&nbsp;</th><th>Sent Time</th></td></tr>";
		while ($data = mysql_fetch_row($query))
		{
			$fromname = $data[2];
			$msg = $data[4];
			$senttime = $timein = date(DATE_RFC822, $data[5]);
			$del = "<a href=\"mail.php?del=".$data[0]."\">X</a>";
			echo "<tr><td>$del</td><td>&nbsp;</td><td>$fromname</td><td>&nbsp;</td><td>$msg</td><td>&nbsp;</td><td>$senttime</td></tr>";
		}
		echo "</table>";
	}
	
?>
<br /><br /><br /><br />
	Send Message:
	
	<form method="post" action="mail.php" name="mailForm">
    To: &nbsp;
    <select name="toU">
                	<option value=""></option>
                    <?php
					$query = mysql_query("SELECT * FROM 588users");

					//print votes in decending order here
					while ($data = mysql_fetch_row($query))
					{
						$u_name = $data[1];
						$fullname = $data[2];
						echo "\t\t\t\t\t<option value=\"$u_name\">$fullname</option>\n";
					}
					?>
        		</select>
                <br /><br />
                Message:<br /><br />
                <textarea name="msg" rows="10" cols="10" /></textarea>
                <br /><br />
                <input type="submit" value="Send Message" />
    </form>

<?php
include ("side.php");
include ("bottom.php");
?>


