<!DOCTYPE html>
<html>

<!-- the head section -->
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
</head>

<!-- the body section -->
<body>
<div class="container">
<?php include('includes/header.php'); ?>
    <!-- <header><h1>My Bike Shop</h1></header> -->

    <main>
        <br>
        <h2 class="top">Error!</h2>
        <p><?php echo $error; ?></p>
        <br>
        <p><a class="manage-button" href="index.php">Return Home</a></p>
    </main>
    <br>
    <?php include('includes/footer.php'); ?>
</div>
    
</body>
</html>