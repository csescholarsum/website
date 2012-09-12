<?php

#make events with a form
include("make_events.php");

echo "<br />";
echo "<br />";

echo "<div class='event_table'>";

#show all events in a table
include("get_events.php");

echo "</div>";
?>