<?php

	//this file is included in order to service an uploaded resume
	//for security, do not permit $uniqname to be blank
	
	if ($uniqname != "")
	{
		$uploadFailed = false;
		if (isset($_FILES['resumeFile']))
		{
			$target_path = "../../resumes/".$uniqname.".pdf"; 
			
			if ($_FILES['resumeFile']['tmp_name'] != "")
			{
				//check if file ends with ".pdf"
				if (substr_compare($_FILES['resumeFile']['name'], ".pdf", -4) === 0)
				{
					if(move_uploaded_file($_FILES['resumeFile']['tmp_name'], $target_path))
					{
						mysql_query("UPDATE members SET hasResume = '1' WHERE uniquename = '$uniqname'");
						$hasResume = 1;
						//create cover file
						$content = "<?php \$uniquename = \"".$uniqname."\"; include(\"template.php\"); ?>";
						$fp = fopen("../resumes/".$uniqname.".pdf", 'w');
						fwrite($fp, $content);
						fclose($fp);
					}
					else
					{
						$uploadFailed = true;
						$notPDF = false;
					}
				}
				else
				{
					$uploadFailed = true;
					$notPDF = true;
				}
			}
		}
	}

?>