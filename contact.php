
<!-- the head section -->
 <div class="container">
<?php
include('includes/header.php');
?>
        <h1>Contact us</h1>
<form method="POST" name="contactform" action="contact-form-handler.php"> 
<p>
<label for='name'>Your Name:</label> <br>
<input type="text" name="name">
</p>
<p>
<label for='dob'>Date of Birth:</label> <br>
<input type="text" name="dob">
</p>
<p>
<label for='email'>Email Address:</label> <br>
<input type="text" name="email"> <br>
</p>
<p>
<label for='phone'>Phone Number:</label> <br>
<input type="text" name="phone"> <br>
</p>
<p>
<label for='message'>Message:</label> <br>
<textarea name="message" rows=5 cols=30></textarea>
</p>
<input type="submit" value="Submit"><br>
</form>

<script language="JavaScript">
var frmvalidator  = new Validator("contactform");
frmvalidator.addValidation("name","req","Please provide your name"); 
frmvalidator.addValidation("dob","req","Please provide your date of birth");
frmvalidator.addValidation("email","req","Please provide your email"); 
frmvalidator.addValidation("email","email","Please enter a valid email address"); 
frmvalidator.addValidation("phone","req","Please provide your phone number");
</script>



<?php include('includes/footer.php'); ?>