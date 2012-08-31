<?php

function FormatGradDate($gradMonth, $gradYear)
{
	if (($gradMonth < 1)||($gradMonth > 12))
	{
		if ($gradYear < 2000)
			return "";
		else
			return $gradYear;
	}
	if ($gradYear < 2000)
		return date( 'F', mktime(0, 0, 0, $gradMonth));
	return date( 'F', mktime(0, 0, 0, $gradMonth)).", ".$gradYear;
}

?>