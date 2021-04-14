<?php
require('database.php');

$bike_id = filter_input(INPUT_POST, 'bike_id', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM bikes
          WHERE bikeID = :bike_id';
$statement = $db->prepare($query);
$statement->bindValue(':bike_id', $bike_id);
$statement->execute();
$bikes = $statement->fetch(PDO::FETCH_ASSOC);
$statement->closeCursor();



?>
<!-- the head section -->
 <div class="container">
<?php
include('includes/header.php');
?>
        <h1>Edit Product</h1>
        <form action="edit_bike.php" method="post" enctype="multipart/form-data"
              id="edit_bike_form">
            <input type="hidden" name="original_image" value="<?php echo $bikes['image']; ?>" />
            <input type="hidden" name="bike_id"
                   value="<?php echo $bikes['bikeID']; ?>">

            <label>Category ID:</label>
            <input type="category_id" name="category_id"
            id="category_id" onBlur="validateCategory();" placeholder="Bike Category" required value="<?php echo $bikes['categoryID']; ?>">
            <span id="categoryValid"></span>
            <br>

            <label>Name:</label>
            <input type="input" name="name"
            id="name" onBlur="validateName();" placeholder="Make and Model of Bike" required value="<?php echo $bikes['name']; ?>">
            <span id="nameValid"></span>
            <br>

            <label>Engine Size:</label>
            <input type="input" name="engineSize"
            id="engineSize" onBlur="validateEngineSize();" placeholder="125cc Or 500cc" required value="<?php echo $bikes['engineSize']; ?>">
            <span id="engineSizeValid"></span>
            <br>

            <label>List Price:</label>
            <input type="input" name="price"
            id="listPrice" onBlur="validateListPrice();" placeholder="Selling Price" required value="<?php echo $bikes['price']; ?>">
            <span id="listPriceValid"></span> 
            <br>

            <label>Last Service:</label>
            <input type="input" name="lastService"
                   value="<?php echo $bikes['lastService']; ?>" id="serviceDate" onBlur="validateServiceDate();" placeholder="Date of Last Service" required>
            <span id="serviceDateValid"></span> 
            <br>

            <label>Image:</label>
            <input type="file" name="image" accept="image/*" />
            <br>            
            <?php if ($bikes['image'] != "") { ?>
            <p id="edit-img"><img src="image_uploads/<?php echo $bikes['image']; ?>" height="150" /></p>
            <?php } ?>
            
            <label>&nbsp;</label>
            <input class="add-button submit-button" type="submit" value="Save Changes">
            <br>
        </form>
        <p><a class="manage-button homepage-button" href="index.php">View Homepage</a></p>
        <br>
    <?php
include('includes/footer.php');
?>