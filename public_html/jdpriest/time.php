<?php
function FormatTime($time)
{
	date_default_timezone_set('America/Detroit');
	return date(DATE_RFC822, $time);
}
?>
