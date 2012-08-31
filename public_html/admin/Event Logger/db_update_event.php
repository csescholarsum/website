<?php
    #important this also init the mysql connection ($con)
    #tbe is event table
    include("db_init.php");
     
    # Add to table $tbe = 'events'
    mysql_select_db($db, $con);
    $sql = "INSERT INTO ". $tbe ."
    (
    eventID,
    Title,
    Date,
    SerHours
    ) 
    VALUES 
    (
    0,
    '$_POST[title]',
    '$_POST[date]',
    '$_POST[serhours]'
    )";

    # Execute query
    mysql_query($sql,$con);

    mysql_close($con);
    
    header( 'Location: index.php' );
?>