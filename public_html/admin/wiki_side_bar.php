</div>
	<!-- start sidebar -->
	<div id="sidebar">
		<ul>
			<li>
				<h2><?php echo $pageName; ?> Resources</h2>
                
                <?php
				$path = "./wiki/$page";
				$i = 0;
				if ($handle = opendir($path))
				{
					while (false !== ($file = readdir($handle)))
					{
						if (($file != ".")&&($file != "..")&&($file != "source.php"))
						{
							$i++;
							echo "\t\t\t\t";
							if ($caller == "edit")
							{
								echo "<a ";
								$loc = strpos($wikiSource, "wiki/$page/$file");
								if(!($loc === false))
									echo "onClick=\"if(!confirm('This file is referenced in the wiki page source.\\n\\nDelete anyway?')) return false;\" ";
								echo "href=\"editwiki.php?page=$page&del=$file\">X</a>&nbsp;";
							}
							echo "<a href=\"wiki/$page/$file\">$file</a><br />\n";
						}
					}
					closedir($handle);
				}
				if ($i == 0)
					echo "\t\t\t\tThere are no resources for this wiki";
				?>
            </li>
		</ul>
	</div> 