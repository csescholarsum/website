<?php

//CREATED BY: jsallans
//DATE: 10-2-12
//CHANGE: new
//PURPOSE: logged out user

unset($_SESSION['USER_UNIQ']);

unset($_SESSION['type']);

//redirect to main page
header("Location: https://web.eecs.umich.edu/~cseschol/index.php");
?>