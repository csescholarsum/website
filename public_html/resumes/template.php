<?php

	//this file is included by <resume>.pdf
	//what I would like to do is make any request to this directory go through a single file which will with return a file or not
	
	function ThrowNotFound()
	{
		header("HTTP/1.1 404 Not Found");
		include("notfound.php");
		exit();
	}
		

	$file = "../../resumes/".$uniquename.".pdf";

	//check if file exists; throw not found if not
	if (!file_exists($file))
		ThrowNotFound();

	//set headers and include pdf
	header('Accept-Ranges: bytes');
	header('Content-Type: application/pdf');
	readfile($file);

?>
