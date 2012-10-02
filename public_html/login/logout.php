<?php

//CREATED BY: jsallans
//DATE: 10-2-12
//CHANGE: new
//PURPOSE: logged out user

session_unset();

//redirect to main page
header("Location: https://web.eecs.umich.edu/~cseschol/index.php");
?>