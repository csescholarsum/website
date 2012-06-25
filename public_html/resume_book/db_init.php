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
    mysql_select_db($db, $con);
?>