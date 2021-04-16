<!-- the head section -->
<head>
<title>My PHP CRUD App</title>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Montserrat:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho+B1:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/mystyle.css">

<script language="JavaScript" src="js/validation.js" type="text/javascript"></script>
<script language="JavaScript" src="js/gen_validatorv31.js" type="text/javascript"></script>
</head>
<!-- the body section -->
<body onload="validateForm();">

<?php
    /**
     * Start the session.
     */
    // session_start();

    /**
     * Check if the user is logged in.
     */
    $loggedIn;
    if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])){
        //User not logged in. Redirect them back to the login.php page.
        // header('Location: login.php');
        // exit;
        $loggedIn = false;
    } 
    else {
        $loggedIn = true;
    }


?>

<header onload="loginButtons('<?php echo $loggedIn; ?>');">
    <h1>My PHP CRUD app</h1>
    <!-- class="active" -->
    <div class="topnav">
        <ul id="header-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="add_bike_form.php">Add Bike</a></li>
            <li><a href="manage_bikes.php">Manage Bikes</a></li>
            <li><a href="category_list.php">Manage Categories</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li id="register"><a href="register.php">Register</a></li>
            <li id="login"><a href="login.php">Login</a></li>
            <li id="logout"><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</header>



