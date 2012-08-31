<?php 
include ("jaketop.php");
?>

<?php
if ($_POST["email"]<>'') {
	$ToEmail = 'envisionopto@yahoo.com';
	$EmailSubject = 'Envision Apointment Request '; 
	$mailheader = "From: ".$_POST["email"]."\r\n"; 
	$mailheader .= "Reply-To: ".$_POST["email"]."\r\n"; 
	$mailheader .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	$MESSAGE_BODY = "Name: ".$_POST["name"]."<br>"; 
	$MESSAGE_BODY .= "Email: ".$_POST["email"]."<br><br>"; 
	$MESSAGE_BODY .= "Text: ".nl2br($_POST["comment"])."<br>"; 
	mail($ToEmail, $EmailSubject, $MESSAGE_BODY, $mailheader) or die ("Failure"); 

?>

Your message was sent.

<?php
} else {

?>

 <div id="appoint">
    	<img src="images/appointmentbook.png" width="219 px" height="150 px" />
        <h2> Fill out this form to request an appointment: </h2><br  />
        
		<form action="form.php" method="post">
        	<input type="text" value="Name" name="name" id="name"  onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" /><br />
            <input type="text" value="Email Address" name="email" id="email" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" /><br />
            <input type="text" value="Phone Number" name="phone" id="phone" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"  /><br  /><br  />
            <textarea onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="comment" value="Comments" cols="45" rows="3" id="comment" wrap="hard">Appointment Request Details</textarea><br  />
            <input type="submit" value="Send Appointment Request" name="Submit"  />
         </form>
     </div>



<?php
};
?>


<?php
include ("jakebottom.php");
?>