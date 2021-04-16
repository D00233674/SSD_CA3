<?php

/**
 * Start the session.
 */
session_start();

/**
 * Check if the user is logged in.
 */
if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])){
    //User not logged in. Redirect them back to the login.php page.
    header('Location: login.php');
    exit;
}
?>

<div class="container">
<?php
include('includes/header.php');
?>
<?php

/**
 * Print out something that only logged in users can see.
 */

echo 'Congratulations! You are logged in!';

require('database.php');
$query = 'SELECT *
          FROM categories
          ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>
<!-- the head section -->
        <h1>Add Bike</h1>
        <form action="add_bike.php" method="post" enctype="multipart/form-data"
              id="add_bike_form">

            <label>Category:</label>
            <select name="category_id">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>
            <label>Name:</label>
            <input type="input" name="name" id="name" onBlur="validateName();" placeholder="Make and Model of Bike" required>
            <span id="nameValid"></span>
            <br>

            <label>Engine Size:</label>
            <input type="input" name="engineSize" id="engineSize" onBlur="validateEngineSize();" placeholder="125cc Or 500cc" required>
            <span id="engineSizeValid"></span>
            <br>

            <label>List Price:</label>
            <input type="input" name="price" id="listPrice" onBlur="validateListPrice();" placeholder="Selling Price" required>
            <span id="listPriceValid"></span> 
            <br>     

            <label>Last Service:</label>
            <input type="input" name="lastService" id="serviceDate" onBlur="validateServiceDate();" placeholder="Date of Last Service" required> 
            <span id="serviceDateValid"></span> 
            <br>   
            
            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>
            
            <label>&nbsp;</label>
            <input class="add-button submit-button" type="submit" value="Add Bike">
            <br>
        </form>
        
    <?php include('includes/footer.php'); ?>