<?php
/*Here we are going to declare the variables*/
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$comment = $_POST['Comment'];

//Save visitor name and entered message into one variable:
$formcontent="Visitor Name: $name.  \r\n Last Name: $last. \r\n Email: $email.  \r\n Phone No: $phone.  \r\n Comment: $comment. ";
$recipient = "info@designhost.in, anil@designhost.in, sale@designhost.in, info.designhost@gmail.com ";
$subject = "Enquiry Form";
$mailheader = "From: $email\\r\\n";
$mailheader .= "Reply-To: $email\\r\\n";
$mailheader .= "MIME-Version: 1.0\\r\\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("Failure!");

?>
<script language="javascript">
	alert("Thank you for contacting us");
	window.location="index.html"
	</script>