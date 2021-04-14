<?php 
$errors = '';
$myemail = 'd00233674@student.dkit.ie';//<-----Put your DkIT email address here.
if(empty($_POST['name'])  || 
   empty($_POST['email']) || 
   empty($_POST['age']) || 
   empty($_POST['message']))
{
    $errors .= "\n Error: all fields are required";
}

$name = $_POST['name']; 
$email_address = $_POST['email']; 
$age = $_POST['age']; 
$message = $_POST['message']; 

if (!preg_match(
"/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", 
$email_address))
{
    $errors .= "\n Error: Invalid email address";
}

if( empty($errors))
{
	$to = $myemail; 
	$email_subject = "Contact form submission: $name";
	$email_body = "You have received a new message. ".
	" Here are the details:\n Name: $name \n Email: $email_address \n Age: $age \n Message \n $message"; 
	
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

<!-- return to form or homepage??? -->


<?php
include('includes/footer.php');
?>