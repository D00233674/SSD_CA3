<?php 
$errors = '';
$myemail = 'd00233674@student.dkit.ie';//<-----Put your DkIT email address here.
if(empty($_POST['name'])  || 
   empty($_POST['dob']) || 
   empty($_POST['email']) || 
   empty($_POST['phone']) || 
   empty($_POST['message']))
{
    $errors .= "\n Error: all fields are required";
}

$name = $_POST['name']; 
$dob = $_POST['dob']; 
$email_address = $_POST['email']; 
$phone = $_POST['phone']; 
$message = $_POST['message']; 

if (!preg_match(
"/^[a-zA-Z ]+$/", 
$name))
{
	$errors .= "\n Error: Invalid name field";
}

if (!preg_match(
"/^(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))$/", 
$dob))
{
	$errors .= "\n Error: Invalid date of birth";
}

if (!preg_match(
"/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", 
$email_address))
{
    $errors .= "\n Error: Invalid email address";
}

if (!preg_match(
"/^\+(353|44)(\d){8}$/", 
$phone))
{
	$errors .= "\n Error: Invalid phone number";
}



if( empty($errors))
{
	$to = $myemail; 
	$email_subject = "Contact form submission: $name";
	$email_body = "You have received a new message. ".
	" Here are the details:\n Name: $name \n Date of Birth: $dob \n Email: $email_address \n Phone Number: $phone \n Message \n $message"; 
	
	$headers = "From: $myemail\n"; 
	$headers .= "Reply-To: $email_address";
	
	mail($to,$email_subject,$email_body,$headers);
	//redirect to the 'thank you' page
	header('Location: contact-form-thank-you.php');
} 
?>
<div class="container">
<?php
include('includes/header.php');
?>
<!-- This page is displayed only if there is some error -->
<?php
echo nl2br($errors);
?>

<!-- return to form or homepage??? can just use nav
<p><a href="contact.php" class="manage-button">Return to Form</a></p>
-->
<?php
include('includes/footer.php');
?>