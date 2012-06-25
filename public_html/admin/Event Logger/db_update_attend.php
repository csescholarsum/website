<?php

    include("db_init.php");
    
    # Add to table $tbe = 'attendies'
    mysql_select_db($db, $con);
    $sql = "INSERT INTO ". $tba ."
    (
    Name,
    Uniqname,
    eventID
    ) 
    VALUES 
    (
    '$_POST[name]',
    '$_POST[uniqname]',
    '$_POST[eventID]'
    )";

    # Execute query
    mysql_query($sql,$con);

    mysql_close($con);
    
    header( "Location: attend.php?eventName=". $_GET['eventName'] ."&eventID=". $_GET['eventID'] ."&SerHours=". $_GET['SerHours'] );
?>