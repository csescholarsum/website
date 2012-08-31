<?php
  #important this document does not close the mysql connection ($con)
    $user = 'cseschol';
    $pass = 'JAwNuTrJ';
    $db = 'csescholars';
    $tbe = 'events';
    $tba = 'attendies';
    $con = mysql_connect('',$user,$pass);
    if (!$con)
      {
          die('Could not connect: ' . mysql_error());
      }
    
    #_Create database
    
    if (mysql_query("CREATE DATABASE $db",$con))
      {
      #echo "<p> Database '". $db ."' created <br />";
      }
    else
      {
      #echo "<p> Database '". $db ."' already exists <br />";
      }
    #_Create new table
    mysql_select_db($db, $con);
    
    #Create Event table
    if (!mysql_query("SELECT 1 FROM ".$tbe." LIMIT 0", $con)) {
    
        $sql = "CREATE TABLE ". $tbe ."
        (
        eventID int NOT NULL AUTO_INCREMENT,
        Title varchar(25),
        Date varchar(25),
        SerHours int,
        PRIMARY KEY (eventID)
        )";

        #_Execute query
        mysql_query($sql,$con);
        
        #echo "Table ". $tbe ." initialized </p>";
    }
    else {
        #echo "Table ". $tbe ." already exists</p>"; 
    }

    #Create Attendies table
    if (!mysql_query("SELECT 1 FROM ".$tba." LIMIT 0", $con)) {
    
        $sql = "CREATE TABLE ". $tba ."
        (
        Name varchar(25),
        Uniqname varchar(25),
        eventID int
        )";

        #_Execute query
        mysql_query($sql,$con);
        
        #echo "Table ". $tba ." initialized </p>";
    }
    else {
        #echo "Table ". $tba ." already exists</p>"; 
    }

?>